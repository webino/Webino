<?php

namespace Webino;

/**
 * Class HttpRouterHandler
 * @package webino-router
 */
class HttpRouterHandler extends AbstractEventHandler
{
    /**
     * @return void
     */
    protected function initEvents(): void
    {
        $this->on(HttpResponseEvent::class, 'configRoutes', HttpResponseEvent::BEGIN);
        $this->on(HttpResponseEvent::class, 'dispatchRoute', HttpResponseEvent::BEFORE);
    }

    /**
     * @param AppEvent $event
     */
    function configRoutes(AppEvent $event): void
    {
        $app = $event->getApp();
        /** @var HttpRouterConfig $routerConfig */
        $routerConfig = $app->get(HttpRouterConfig::class);
        /** @var HttpRouter $router */
        $router = $app->get(HttpRouter::class);
        $routerConfig->configRouter($router);
    }

    /**
     * @param HttpResponseEvent $event
     * @return mixed
     */
    function dispatchRoute(HttpResponseEvent $event)
    {
        $app = $event->getApp();
        /** @var HttpRouter $router */
        $router = $app->get(HttpRouter::class);

        // TODO route dispatch callback
        $response = $router->dispatch($event, function ($route) use ($app) {
            $routeClass = get_class($route);
            if (defined("$routeClass::VIEW")) {
                $app->setState(constant("$routeClass::VIEW"));
            }
        });

        return $response;
    }
}
