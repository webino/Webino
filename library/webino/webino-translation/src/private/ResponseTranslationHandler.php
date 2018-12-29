<?php

namespace Webino;

/**
 * Class ResponseTranslationHandler
 * @package webino-translation
 */
class ResponseTranslationHandler extends AbstractEventHandler
{
    /**
     * @return void
     */
    protected function initEvents(): void
    {
        $this->on(BootstrapEvent::class, 'configTranslation', BootstrapEvent::AFTER);
        $this->on(HttpResponseEvent::class, 'onResponse', HttpResponseHandler::PRIORITY);
    }

    /**
     * @param BootstrapEvent $event
     */
    function configTranslation(BootstrapEvent $event): void
    {
        $app = $event->getApp();
        /** @var Translator $translator */
        $translator = $app->get(Translator::class);
        /** @var TranslationConfig $translationConfig */
        $translationConfig = $app->get(TranslationConfig::class);
        $translationConfig->configTranslator($translator);
    }

    /**
     * Translate response string
     *
     * @param HttpResponseEvent $event
     */
    function onResponse(HttpResponseEvent $event): void
    {
        $app = $event->getApp();
        /** @var Translator $translator */
        $translator = $app->get(Translator::class);
        $translation = $translator->getTranslation(\Locale::getDefault());

        $response = $event->getResponse();
        $newResponse = $translation->translate($response);

        $event->setResponse($newResponse);
    }
}
