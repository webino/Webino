<?php

namespace Webino;

/**
 * Class RouterConfig
 * @package webino-router
 */
class RouterConfig
{
    /**
     * @var FilesystemInterface
     */
    private $filesystem;

    /**
     * @var iterable
     */
    private $routes = [];

    /**
     * @param CreateServiceEvent $event
     * @return RouterConfig
     */
    static function create(CreateServiceEvent $event): RouterConfig
    {
        $app = $event->getApp();
        return new static($app);
    }

    /**
     * @param FilesystemInterface $filesystem
     */
    function __construct(FilesystemInterface $filesystem)
    {
        $this->filesystem = $filesystem;
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
        foreach ($this->filesystem->getFileList($dirPath)->forRegex('~\/.+Route\.php$~') as $item) {
            $className = '\Webino\\' . $item->getName();
            $this->configRoute($className);
        }
    }

    /**
     * Configure router
     *
     * @param Router $router
     */
    function configRouter(Router $router): void
    {
        // TODO cache

        foreach ($this->routes as $class) {
            $route = null;

            if (defined("$class::PATH")) {
                $routePath = constant("$class::PATH");
                $route = new Route($class, $routePath);

                defined("$class::RULES")
                    and $route->setRules((array) constant("$class::RULES"));

                defined("$class::DEFAULTS")
                    and $route->setDefaults((array) constant("$class::DEFAULTS"));

                defined("$class::METHOD")
                    and $route->setMethods((array) constant("$class::METHOD"));

                defined("$class::SCHEME")
                    and $route->setSchemes((array) constant("$class::SCHEME"));

                defined("$class::HOST")
                    and $route->setHost(constant("$class::HOST"));

                defined("$class::OPTIONS")
                    and $route->setOptions((array) constant("$class::OPTIONS"));

                defined("$class::CONDITION")
                    and $route->setCondition(constant("$class::CONDITION"));
            }

            $event = null;
            if (method_exists($class, 'configure')) {
                $event = new RouteConfigEvent;
                $event->setRouter($router);
                $route and $event->setRoute($route);
                call_user_func("$class::configure", $event);
            }

            $event and $route = $event->getRoute();
            $route and $router->addRoute($route);
        }
    }
}
