<?php

namespace Webino\Handler;

use Webino\App;
use Webino\Event;
use Webino\Event\ConsoleErrorEvent;
use Webino\Event\ConsoleResponseEvent;
use Webino\Event\ResponseErrorEvent;
use Webino\Event\ResponseEvent;

/**
 * Class ConsoleResponseHandler
 */
class ConsoleResponseHandler extends ResponseHandler
{
    /**
     * @param App $app
     * @return ConsoleResponseHandler
     */
    public static function create(App $app): ConsoleResponseHandler
    {
        return new static;
    }

    /**
     * @return void
     */
    protected function initEvents(): void
    {
        $this->on(ResponseEvent::class, $this, ResponseEvent::FINISH);
        $this->on(ResponseErrorEvent::class, 'onError', ResponseErrorEvent::FINISH);
        $this->on(ConsoleResponseEvent::class, 'onResponse', ConsoleResponseEvent::FINISH);
        $this->on(ConsoleErrorEvent::class, 'onResponse', ConsoleErrorEvent::FINISH);
    }

    /**
     * @param Event $event
     */
    public function __invoke(Event $event)
    {
        $event->getTarget()->emit(new ConsoleResponseEvent);
    }

    /**
     * @param Event $event
     */
    public function onError(Event $event)
    {
        $consoleEvent = new ConsoleErrorEvent($event);
        $consoleEvent->setExitCode(1);
        $event->getTarget()->emit($consoleEvent);
    }

    /**
     * @param ConsoleResponseEvent $event
     */
    public function onResponse(ConsoleResponseEvent $event)
    {
        echo $event->getResults();
        exit($event->getExitCode());
    }
}
