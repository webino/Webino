<?php

namespace Webino;

/**
 * Class HttpRouter
 * @package webino-router
 */
class HttpRouter implements RouterInterface
{
    /**
     * Root route
     */
    const ROOT = '';

    /**
     * Error 404 route
     */
    const E404 = 'E404';

    /**
     * Rewritten URL format
     */
    const URL_FORMAT_REWRITE = '/%s';

    /**
     * URL query format
     */
    const URL_FORMAT_QUERY = '?%s';

    /**
     * @var InstanceContainerInterface
     */
    private $instances;

    /**
     * @var iterable
     */
    private $routes = [];

    /**
     * @var iterable
     */
    private $paths = [];

    /**
     * @var HttpBasePathInterface
     */
    private $basePath;

    /**
     * @var HttpRequestUriInterface
     */
    private $requestUri;

    /**
     * URL format
     *
     * @var string
     */
    private $urlFormat = '/%s';

    /**
     * @param CreateServiceEvent $event
     * @return HttpRouter
     */
    static function create(CreateServiceEvent $event): HttpRouter
    {
        $app = $event->getApp();
        $basePath = $app->get(HttpBasePathInterface::class);
        $requestUri = $app->get(HttpRequestUriInterface::class);
        return new static($app, $basePath, $requestUri);
    }

    /**
     * @param InstanceContainerInterface $instances
     * @param HttpBasePathInterface $basePath
     */
    function __construct(InstanceContainerInterface $instances, HttpBasePathInterface $basePath, HttpRequestUriInterface $requestUri)
    {
        $this->instances = $instances;
        $this->basePath = $basePath;
        $this->requestUri = $requestUri;
    }

    /**
     * Set URL format
     *
     * e.g.: /%s For rewritten URL
     *       ?%s For query param URL
     *
     * @param string $urlFormat
     */
    public function setUrlFormat(string $urlFormat): void
    {
        $this->urlFormat = $urlFormat;
    }

    /**
     * Returns route hypertext reference
     *
     * @param string $route
     * @return string|null
     */
    function url(string $route): ?string
    {
        $class = sprintf('\Webino\\%sRoute', ucfirst($route));

        $routeBase = (string) $this->basePath;
        if (empty($this->paths[$class])) {
            return array_key_exists($class, $this->paths) ? $routeBase : null;
        }

        $path = $this->paths[$class];
        $href = $path ? sprintf($routeBase . $this->urlFormat, $path) : $routeBase;

        return $href;
    }

    /**
     * Route path to class
     *
     * @param string $routePath
     * @param string $routeClass
     */
    function route(string $routePath, string $routeClass): void
    {
        $this->routes[$routePath] = $routeClass;
        $this->paths[$routeClass] = $routePath;
    }

    /**
     * @param HttpResponseEvent $event
     * @param callable|null $callback
     * @throws NotFoundStatusException
     * @return mixed
     */
    function dispatch(HttpResponseEvent $event, callable $callback = null)
    {
        $request = $event->getRequest();
        $route = $request->getRoutePath() ?: $this::ROOT;
        $class = $this->routes[$route] ?? null;

        // not found
        if (empty($class)) {
            $route = $this::E404;
            $class = $this->routes[$route] ?? null;
        }

        if (empty($class)) {
            // no route
            throw new NotFoundStatusException('404 Not Found');
        }

        $routeDispatchEvent = new RouteDispatchEvent($event);
        $obj = $this->instances->get($class);
        $callback and $callback($obj);

        if (method_exists($obj, 'dispatch')) {
            return $obj->dispatch($routeDispatchEvent);
        }

        return null;
    }
}
