<?php

namespace Webino;

/**
 * Class ErrorHandler
 * @package webino-responder
 */
class ErrorHandler extends AbstractEventHandler
{
    /**
     * @return void
     */
    protected function initEvents(): void
    {
        $this->on(HttpErrorEvent::class, 'onHttpError', HttpErrorEvent::AFTER);
        $this->on(ConsoleErrorEvent::class, 'onConsoleError', ConsoleErrorEvent::AFTER);
    }

    /**
     * @param HttpErrorEvent $event
     * @return string
     */
    function onHttpError(HttpErrorEvent $event)
    {
        // TODO custom template
        return sprintf('E %d <br> %s', $event->getStatus()->getCode(), $event->getException());
    }

    /**
     * @param ConsoleErrorEvent $event
     * @return string
     */
    function onConsoleError(ConsoleErrorEvent $event)
    {
        // TODO console error message
        return 'CLI error occured' . PHP_EOL . $event->getException();
    }
}
