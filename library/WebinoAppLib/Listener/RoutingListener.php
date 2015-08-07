<?php

namespace WebinoAppLib\Listener;

use WebinoAppLib\Event\AppEvent;
use WebinoAppLib\Event\DispatchEvent;
use WebinoAppLib\Event\RouteEvent;
use WebinoEventLib\AbstractListener;
use Zend\Mvc\ResponseSender;
use Zend\Mvc\Service\RequestFactory;
use Zend\Stdlib\ResponseInterface;

/**
 * Class RoutingListener
 */
final class RoutingListener extends AbstractListener
{
    /**
     * Initialize listener
     */
    public function init()
    {
        $this->listen(AppEvent::DISPATCH, [$this, 'createRequest'], AppEvent::BEGIN * 999);
        $this->listen(AppEvent::DISPATCH, [$this, 'matchRoute'], AppEvent::BEFORE * 999);
        $this->listen(AppEvent::DISPATCH, [$this, 'sendResponse'], AppEvent::FINISH * 999);
    }

    /**
     * @param DispatchEvent $event
     */
    public function createRequest(DispatchEvent $event)
    {
        $request = (new RequestFactory)->createService($event->getApp()->getServices());
        $event->setParam(DispatchEvent::REQUEST, $request);
    }

    /**
     * @param DispatchEvent $event
     */
    public function matchRoute(DispatchEvent $event)
    {
        $app = $event->getApp();

        /** @var \Zend\Mvc\Router\Http\RouteMatch $routeMatch */
        $routeMatch = $app->getRouter()->match($event->getRequest());
        if (empty($routeMatch)) {
            $app->emit(RouteEvent::NO_MATCH, $event);
            return;
        }

        $routeEvent = new RouteEvent($event);
        $routeEvent->setParam(RouteEvent::ROUTE_MATCH, $routeMatch);

        // binding to a route match to emit matched route event
        $app->bind(RouteEvent::MATCH, function (RouteEvent $event) use ($app, $routeMatch) {
            $routeEvent  = clone $event;
            $activeRoute = $routeMatch->getMatchedRouteName();

            if (interface_exists($activeRoute)) {
                $routeEvent->setName($activeRoute);
            } else {
                $routeEvent->setName(RouteEvent::PREFIX . $activeRoute);
            }

            // matched route event
            $app->emit($routeEvent);
        });

        // route match event
        $app->emit($routeEvent);
    }

    /**
     * @param DispatchEvent $event
     */
    public function sendResponse(DispatchEvent $event)
    {
        $response = $event->getResponse();
        empty($response) or $this->respond($response);
    }

    /**
     * @param ResponseInterface $response
     */
    private function respond(ResponseInterface $response)
    {
        $event = new ResponseSender\SendResponseEvent;
        $event->setResponse($response);

        foreach ($this->getResponders() as $responder) {
            $responder($event);
        }
    }

    /**
     * @return \Zend\Mvc\ResponseSender\ResponseSenderInterface[]
     */
    private function getResponders()
    {
        return [
            new ResponseSender\PhpEnvironmentResponseSender,
            new ResponseSender\ConsoleResponseSender,
            new ResponseSender\SimpleStreamResponseSender,
            new ResponseSender\HttpResponseSender,
        ];
    }
}
