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

            // routes
            /** @var RouterConfig $routerConfig */
            $routerConfig = $app->get(RouterConfig::class);
            $routerConfig->configRouteClasses('system://routes');

            // translations
            /** @var TranslationConfig $translationConfig */
            $translationConfig = $app->get(TranslationConfig::class);
            $translationConfig->configTranslation('system://translation');
        });
    }
}
