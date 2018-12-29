<?php

namespace Webino;

/**
 * Class HttpResponseHandler
 * @package webino-responder
 */
class HttpResponseHandler extends AbstractEventHandler
{
    /**
     * Response handler priority
     */
    const PRIORITY = HttpResponseEvent::FINISH - 999;

    /**
     * @var InstanceContainerInterface
     */
    private $instances;

    /**
     * @param CreateServiceEvent $event
     * @return HttpResponseHandler
     */
    static function create(CreateServiceEvent $event): HttpResponseHandler
    {
        return new static($event->getApp());
    }

    /**
     * @param InstanceContainerInterface $instances
     */
    function __construct(InstanceContainerInterface $instances)
    {
        $this->instances = $instances;
    }

    /**
     * @return void
     */
    protected function initEvents(): void
    {
        $this->on(ResponseEvent::class, $this, $this::PRIORITY + 1);
        $this->on(ResponseErrorEvent::class, 'onError', $this::PRIORITY + 1);
        $this->on(HttpResponseEvent::class, 'onResponse', $this::PRIORITY + 1);
        $this->on(HttpResponseEvent::class, 'sendResponse', $this::PRIORITY - Event::OFFSET);
        $this->on(HttpErrorEvent::class, 'onResponse', $this::PRIORITY + 1);
    }

    /**
     * @param ResponseEvent $event
     * @throws \Throwable
     */
    function __invoke(ResponseEvent $event)
    {
        $httpEvent = new HttpResponseEvent;
        $this->setupHttpEvent($httpEvent);

        try {
            $event->getTarget()->emit($httpEvent, function ($result) use ($httpEvent) {
                empty($result) or $httpEvent->setResponse($result);
            });
        } catch (\Throwable $exc) {
            $event->getApp()->error($exc);
            throw $exc;
        }
    }

    /**
     * @param ResponseEvent $event
     * @throws \Throwable
     */
    function onError(ResponseEvent $event)
    {
        $httpErrorEvent = new HttpErrorEvent($event);
        $this->setupHttpEvent($httpErrorEvent);

        try {
            $event->getTarget()->emit($httpErrorEvent, function ($result) use ($httpErrorEvent) {
                empty($result) or $httpErrorEvent->setResponse($result);
            });
        } catch (\Throwable $exc) {
            $event->getApp()->error($exc);
            throw $exc;
        }
    }

    /**
     * @param HttpResponseEvent $event
     */
    function onResponse(HttpResponseEvent $event)
    {
        $response = $event->getResponse();
        if ($response) {
            if (is_string($response)) {
                $response = new TextResponse($response);
            }
            if ($response instanceof HttpResponseInterface) {
                $event->getHeaders()->set($response->getContentType());
                $event->setResponse($response);
            }
        } else {
            $event->setStatus(new HttpStatus\NoContent);
        }

        $event->getStatus()->send();
        $event->getHeaders()->send();
        $event->setResponse((string) $response);
    }

    /**
     * @param HttpResponseEvent $event
     */
    function sendResponse(HttpResponseEvent $event)
    {
        echo $event->getResponse();
    }

    /**
     * @param HttpEventInterface $event
     */
    private function setupHttpEvent(HttpEventInterface $event)
    {
        $request = $this->instances->get(HttpRequestInterface::class);
        $event->setRequest($request);
    }
}
