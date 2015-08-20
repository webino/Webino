<?php

namespace WebinoAppLib\Listener;

use WebinoAppLib\Event\AppEvent;
use WebinoAppLib\Event\DispatchEvent;
use WebinoAppLib\Event\RouteEvent;
use WebinoEventLib\AbstractListener;

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
        $this->listen(AppEvent::DISPATCH, [$this, 'matchRoute'], AppEvent::BEFORE * 999);
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
            $routeEvent = clone $event;
            $routeEvent->setName($routeMatch->getMatchedRouteName());

            // matched route event
            $app->emit($routeEvent);
        });

        // route match event
        $app->emit($routeEvent);
    }
}
