<?php

namespace WebinoAppLib\Listener;

use WebinoAppLib\Event\AbstractRouteEvent;
use WebinoAppLib\Event\AppEvent;
use WebinoAppLib\Event\DispatchEvent;
use WebinoEventLib\AbstractListener;

/**
 * Class AbstractRoutingListener
 */
abstract class AbstractRoutingListener extends AbstractListener
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
            $app->emit(AbstractRouteEvent::NO_MATCH, $event);
            return;
        }

        $routeEvent = $this->createRouteEvent($event);
        $routeEvent->setEventParam(AbstractRouteEvent::ROUTE_MATCH, $routeMatch);

        // binding to a route match to emit matched route event
        $app->bind(AbstractRouteEvent::MATCH, function (AbstractRouteEvent $event) use ($app, $routeMatch) {
            $routeEvent = clone $event;
            $routeEvent->setName($routeMatch->getMatchedRouteName());

            // matched route event
            $app->emit($routeEvent);
        });

        // route match event
        $app->emit($routeEvent);
    }

    /**
     * @param DispatchEvent $event
     * @return \WebinoAppLib\Event\AbstractRouteEvent
     */
    abstract protected function createRouteEvent(DispatchEvent $event);
}
