<?php

namespace Webino;

/**
 * Class HttpResponseHandler
 * @package webino-responder
 */
class HttpResponseHandler extends ResponseHandler
{
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
    public function __construct(InstanceContainerInterface $instances)
    {
        $this->instances = $instances;
    }

    /**
     * @return void
     */
    protected function initEvents(): void
    {
        $this->on(ResponseEvent::class, $this, ResponseEvent::FINISH - 999);
        $this->on(ResponseErrorEvent::class, 'onError', ResponseErrorEvent::FINISH - 999);
        $this->on(HttpResponseEvent::class, 'onResponse', HttpResponseEvent::FINISH - 999);
        $this->on(HttpErrorEvent::class, 'onResponse', HttpErrorEvent::FINISH - 999);
    }

    /**
     * @param Event $event
     * @throws \Throwable
     */
    function __invoke(Event $event)
    {
        $httpEvent = new HttpResponseEvent;
        $this->setupHttpEvent($httpEvent);

        try {
            $event->getTarget()->emit($httpEvent, function ($result) use ($httpEvent) {
                if (empty($result)) {
                    return;
                }
                if (is_string($result)) {
                    $result = new TextResponse($result);
                }
                if ($result instanceof HttpResponseInterface) {
                    $httpEvent->getHeaders()->set($result->getContentType());
                    $httpEvent->setResponse($result);
                }
            });
        } catch (\Throwable $exc) {
            // TODO logger
            die($exc);
            throw $exc;
        }
    }

    /**
     * @param Event $event
     */
    function onError(Event $event)
    {
        $httpErrorEvent = new HttpErrorEvent($event);
        $this->setupHttpEvent($httpErrorEvent);
        $event->getTarget()->emit($httpErrorEvent);
    }

    /**
     * @param HttpResponseEvent $event
     */
    function onResponse(HttpResponseEvent $event)
    {
        $response = $event->getResponse();
        $response or $event->setStatus(new HttpStatus\NoContent);

        $event->getStatus()->send();
        $event->getHeaders()->send();
        echo $response;
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
