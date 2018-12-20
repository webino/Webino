<?php

namespace Webino;

/**
 * Class DefaultModule
 * @package webino-system
 */
class DefaultModule extends AbstractEventHandler
{
    /**
     * @return void
     */
    protected function initEvents(): void
    {
        $this->on(BootstrapEvent::class, function (BootstrapEvent $event) {
            $app = $event->getApp();

            /** @var HttpRouter $router */
            $router = $app->get(HttpRouter::class);
            // TODO configurable
            $router->setUrlFormat($router::URL_FORMAT_REWRITE);

            // routes
            /** @var HttpRouterConfig $routerConfig */
            $routerConfig = $app->get(HttpRouterConfig::class);
            $routerConfig->configRouteClasses('system://routes');
        });
    }
}
