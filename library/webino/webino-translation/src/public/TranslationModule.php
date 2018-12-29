<?php

namespace Webino;

/**
 * Class TranslationModule
 * @package webino-translation
 */
class TranslationModule extends AbstractEventHandler
{
    /**
     * @return void
     */
    protected function initEvents(): void
    {
        // config translation
        $this->on(BootstrapEvent::class, function (BootstrapEvent $event) {

            $app = $event->getApp();

            // translations
            /** @var TranslationConfig $translationConfig */
            $translationConfig = $app->get(TranslationConfig::class);
            $translationConfig->configTranslation(__DIR__ . '/../system/translation');
        });

        // translate response
        $this->on(ResponseTranslationHandler::class);
    }
}
