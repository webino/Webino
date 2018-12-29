<?php

namespace Webino;

/**
 * Class RouterHandler
 * @package webino-router
 */
class RouterHandler extends AbstractEventHandler
{
    /**
     * @return void
     */
    protected function initEvents(): void
    {
        $this->on(HttpResponseEvent::class, 'configRoutes', HttpResponseEvent::BEGIN);
        $this->on(HttpResponseEvent::class, 'dispatchRoute', HttpResponseEvent::BEFORE);
        $this->on(RouteDispatchEvent::class, 'onRouteDispatch', RouteDispatchEvent::AFTER);
    }

    /**
     * @param AppEvent $event
     */
    function configRoutes(AppEvent $event): void
    {
        $app = $event->getApp();
        /** @var RouterConfig $routerConfig */
        $routerConfig = $app->get(RouterConfig::class);
        /** @var Router $router */
        $router = $app->get(Router::class);
        $routerConfig->configRouter($router);
    }

    /**
     * @param HttpResponseEvent $event
     * @return mixed
     */
    function dispatchRoute(HttpResponseEvent $event)
    {
        $app = $event->getApp();
        /** @var Router $router */
        $router = $app->get(Router::class);
        $response = $router->dispatch($event);
        return $response;
    }

    /**
     * @param RouteDispatchEvent $event
     */
    function onRouteDispatch(RouteDispatchEvent $event): void
    {
        $app = $event->getApp();
        $route = $event->getRoute();

        $routeClass = get_class($route);
        if (defined("$routeClass::VIEW")) {
            $view = [];

            // merge route parents view
            foreach (class_parents($routeClass) as $routeParentClass) {
                defined("$routeParentClass::VIEW")
                    and $view+= constant("$routeParentClass::VIEW");
            }

            // set view to app state
            $view = constant("$routeClass::VIEW") + $view;
            $app->setState($view);
        }
    }
}
