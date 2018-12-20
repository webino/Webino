<?php

namespace Webino;

/**
 * Interface ResponseHandler
 * @package webino-responder
 */
class ResponseHandler extends AbstractEventHandler implements
    ResponseHandlerInterface
{
    /**
     * @param CreateServiceEvent $event
     * @return ResponseHandlerInterface
     */
    static function create(CreateServiceEvent $event)
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
     * @param Event $event
     */
    function __invoke(Event $event)
    {
        $event->getTarget()->emit(new ResponseEvent($event));
    }

    /**
     * @param Event $event
     */
    function onError(Event $event)
    {
        $event->getTarget()->emit(new ResponseErrorEvent($event));
    }
}
