<?php

namespace Webino;

/**
 * Class SystemModule
 * @package webino-system
 */
class SystemModule extends AbstractEventHandler
{
    /**
     * @return void
     */
    protected function initEvents(): void
    {
        $this->on(BootstrapEvent::class, function (BootstrapEvent $event) {

            $app = $event->getApp();

            // routes
            $routerConfig = $app->get(RouterConfig::class);
            $routerConfig->configRouteClasses(__DIR__ . '/../system/routes');
        });
    }
}
