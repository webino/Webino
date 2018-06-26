<?php

namespace Webino\Handler;

use Webino\AbstractEventHandler;
use Webino\App;
use Webino\Event;
use Webino\Event\DispatchErrorEvent;
use Webino\Event\DispatchEvent;
use Webino\Event\ResponseErrorEvent;
use Webino\Event\ResponseEvent;
use Webino\IsConsole;

/**
 * Interface ResponseHandler
 */
class ResponseHandler extends AbstractEventHandler implements
    ResponseHandlerInterface
{
    /**
     * @param App $app
     * @return ResponseHandlerInterface
     */
    public static function create(App $app)
    {
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
    public function __invoke(Event $event)
    {
        $event->getTarget()->emit(new ResponseEvent($event));
    }

    /**
     * @param Event $event
     */
    public function onError(Event $event)
    {
        $event->getTarget()->emit(new ResponseErrorEvent($event));
    }
}
