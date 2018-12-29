<?php

namespace Webino;

/**
 * Class ResponseHandler
 * @package webino-responder
 */
class ResponseHandler extends AbstractEventHandler
{
    /**
     * @param CreateServiceEvent $event
     * @return ResponseHandler
     */
    static function create(CreateServiceEvent $event): ResponseHandler
    {
        $app = $event->getApp();
        /** @var IsConsole $isConsole */
        $isConsole = $app->get(IsConsole::class);
        $app->on($isConsole() ? ConsoleResponseHandler::class : HttpResponseHandler::class);
        $app->on(ErrorHandler::class);
        return new static;
    }

    /**
     * @return void
     */
    protected function initEvents(): void
    {
        $this->on(DispatchEvent::class, $this, DispatchEvent::FINISH);
        $this->on(DispatchErrorEvent::class, 'onError', DispatchErrorEvent::FINISH);
    }

    /**
     * @param AppEvent $event
     */
    function __invoke(AppEvent $event)
    {
        $event->getTarget()->emit(new ResponseEvent($event));
    }

    /**
     * @param AppEvent $event
     */
    function onError(AppEvent $event)
    {
        $event->getTarget()->emit(new ResponseErrorEvent($event));
    }
}
