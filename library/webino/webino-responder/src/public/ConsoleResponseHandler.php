<?php

namespace Webino;

/**
 * Class ConsoleResponseHandler
 * @package webino-responder
 */
class ConsoleResponseHandler extends AbstractEventHandler
{
    /**
     * @return ConsoleResponseHandler
     */
    static function create(): ConsoleResponseHandler
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
     * @param ResponseEvent $event
     */
    function __invoke(ResponseEvent $event)
    {
        $event->getTarget()->emit(new ConsoleResponseEvent);
    }

    /**
     * @param ResponseEvent $event
     */
    function onError(ResponseEvent $event)
    {
        $consoleEvent = new ConsoleErrorEvent($event);
        $consoleEvent->setExitCode(1);
        $event->getTarget()->emit($consoleEvent);
    }

    /**
     * @param ConsoleResponseEvent $event
     */
    function onResponse(ConsoleResponseEvent $event)
    {
        echo $event->getResults();
        exit($event->getExitCode());
    }
}
