<?php

namespace Webino;

use Psr\Log\LoggerInterface;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

/**
 * Class Router
 * @package webino-router
 */
class Router implements RouterInterface
{
    /**
     * Root route
     */
    const ROOT = '';

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
    private $container;

    /**
     * @var RouteCollection
     */
    private $routes;

    /**
     * @var HttpRequestContext
     */
    private $requestContext;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var UrlGenerator
     */
    private $urlGenerator;

    /**
     * @param CreateServiceEvent $event
     * @return Router
     */
    static function create(CreateServiceEvent $event): Router
    {
        $app = $event->getApp();
        $context = $app->get(HttpRequestContext::class);
        return new static($app, $context, $app);
    }

    /**
     * @param InstanceContainerInterface $container
     * @param HttpRequestContext $requestContext
     * @param LoggerInterface $logger
     */
    function __construct(
        InstanceContainerInterface $container,
        HttpRequestContext $requestContext,
        LoggerInterface $logger
    ) {
        $this->container = $container;
        $this->requestContext = $requestContext;
        $this->logger = $logger;
    }

    /**
     * Add a route
     *
     * @param RouteInterface $route
     */
    function addRoute(RouteInterface $route): void
    {
        $this->routes
            or $this->routes = new RouteCollection;

        $routerRoute = new Route(
            $route->getPath(),
            $route->getDefaults(),
            $route->getRules(),
            $route->getOptions(),
            $route->getHost(),
            $route->getSchemes(),
            $route->getMethods(),
            $route->getCondition()
        );

        $this->routes->add($route->getClass(), $routerRoute);
        $this->urlGenerator = null;
    }

    /**
     * Returns route hypertext reference
     *
     * @param string $route
     * @param array $params
     * @return string|null
     */
    function url(string $route, $params = []): ?string
    {
        try {
            $class = sprintf('\Webino\\%sRoute', ucfirst($route));
            return $this->getUrlGenerator()->generate($class, $params);
        } catch (\Throwable $exc) {
            $this->logger->notice($exc);
        }

        return null;
    }

    /**
     * Dispatch matched route
     *
     * @param HttpResponseEvent $event
     * @param callable|null $callback
     * @throws NotFoundStatusException
     * @return mixed
     */
    function dispatch(HttpResponseEvent $event, callable $callback = null)
    {
        $app = $event->getApp();
        $request = $event->getRequest();
        $path = $request->getRoutePath() ?: $this::ROOT;
        $routeMatch = [];

        try {
            $matcher = new UrlMatcher($this->routes, $this->requestContext);
            $routeMatch = $matcher->match("/$path");
            $class = $routeMatch['_route'] ?? null;
        } catch (\Throwable $exc) {
            $this->logger->notice($exc);
        }

        $this->requestContext->addParameters($routeMatch);

        // not found
        empty($class) and $class = E404Route::class;

        if (empty($class)) {
            // no route
            throw new NotFoundStatusException('404 Not Found');
        }

        // create route
        $route = $this->container->get($class);
        $callback and $callback($route);

        // dispatch route
        $dispatchEvent = new RouteDispatchEvent($event);
        $dispatchEvent->setRoute($route);
        $dispatchEvent->setValues($routeMatch);
        $app->emit($dispatchEvent);

        if (method_exists($route, 'dispatch')) {
            return $route->dispatch($dispatchEvent);
        }

        return null;
    }

    /**
     * @return UrlGenerator
     */
    public function getUrlGenerator(): UrlGenerator
    {
        $this->urlGenerator or $this->urlGenerator = new UrlGenerator($this->routes, $this->requestContext);
        return $this->urlGenerator;
    }
}
