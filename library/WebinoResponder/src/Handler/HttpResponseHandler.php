<?php

namespace Webino\Handler;

use Webino\App;
use Webino\Event;
use Webino\Event\HttpErrorEvent;
use Webino\Event\HttpResponseEvent;
use Webino\Event\ResponseErrorEvent;
use Webino\Event\ResponseEvent;
use Webino\Exception\NoContentStatusException;
use Webino\HttpResponseInterface;

/**
 * Class HttpResponseHandler
 */
class HttpResponseHandler extends ResponseHandler
{
    /**
     * @param App $app
     * @return HttpResponseHandler
     */
    public static function create(App $app): HttpResponseHandler
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
        $this->on(HttpResponseEvent::class, 'onResponse', HttpResponseEvent::FINISH);
        $this->on(HttpErrorEvent::class, 'onResponse', HttpErrorEvent::FINISH);
    }

    /**
     * @param Event $event
     */
    public function __invoke(Event $event)
    {
        $httpEvent = new HttpResponseEvent;

        $event->getTarget()->emit($httpEvent, function ($result) use ($httpEvent) {
            if ($result instanceof HttpResponseInterface) {
                $httpEvent->getHeaders()->set($result->getContentType());
            }
        });
    }

    /**
     * @param Event $event
     */
    public function onError(Event $event)
    {
        $event->getTarget()->emit(new HttpErrorEvent($event));
    }

    /**
     * @param HttpResponseEvent $event
     */
    public function onResponse(HttpResponseEvent $event)
    {
        $content = (string) $event->getResults();
        if (!$content) {
            throw new NoContentStatusException;
        }

        $event->getStatus()->send();
        $event->getHeaders()->send();
        echo $content;
    }
}
