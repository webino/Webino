<?php

namespace Webino;

/**
 * Class HttpRouterConfig
 * @package webino-router
 */
class HttpRouterConfig
{
    /**
     * @var AppInterface
     */
    private $app;

    /**
     * @var iterable
     */
    private $routes = [];

    /**
     * @param CreateServiceEvent $event
     * @return HttpRouterConfig
     */
    static function create(CreateServiceEvent $event): HttpRouterConfig
    {
        $app = $event->getApp();
        return new static($app);
    }

    /**
     * @param AppInterface $app
     */
    function __construct(AppInterface $app)
    {
        $this->app = $app;
    }

    /**
     * Set route
     *
     * @param string $className
     */
    function configRoute(string $className): void
    {
        $this->routes[$className] = $className;
    }

    /**
     * Register routes classes
     *
     * @param string $dirPath Routes classes directory path
     */
    function configRouteClasses(string $dirPath): void
    {
        foreach ($this->app->getFileList($dirPath)->forRegex('~\/.+Route\.php$~') as $item) {
            $className = '\Webino\\' . $item->getName();
            $this->configRoute($className);
        }
    }

    /**
     * Configure router
     *
     * @param HttpRouter $router
     */
    function configRouter(HttpRouter $router): void
    {
        foreach ($this->routes as $class) {
            $event = new RouteConfigEvent;
            $event->setRouter($router);

            if (defined("$class::PATH")) {
                $router->route(constant("$class::PATH"), $class);
            }

            if (method_exists($class, 'configure')) {
                call_user_func("$class::configure", $event);
            }
        }
    }
}
