<?php
/**
 * Route Config
 * Webino Example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Feature\Listener;
use WebinoAppLib\Listener\RouteListenerTrait;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;
use WebinoHtmlLib\Html;
use WebinoConfigLib\Feature\Route;
use WebinoEventLib\AbstractListener;

require __DIR__ . '/../../vendor/autoload.php';

abstract class MyRoutes
{
    const MY = 'myRoute';
}

/**
 * Listener aggregate
 */
class MyListener extends AbstractListener
{
    use RouteListenerTrait;

    protected function init()
    {
        /**
         * Handling default route.
         */
        $this->listen(DefaultRoute::class, function (RouteEvent $event) {
            $event->setResponse([
                new Html\Text('Hello Webino!'),
                $event->getApp()->url(MyRoutes::MY)->html('Go to MyRoute'),
                new SourcePreview(__FILE__),
            ]);
        });

        /**
         * Handling custom route.
         */
        $this->listenRoute(MyRoutes::MY, function (RouteEvent $event) {
            $event->setResponse([
                new Html\Text('My Route Example!'),
                $event->getApp()->url(DefaultRoute::class)->html('Go Home'),
            ]);
        });
    }
}

$config = Webino::config([
    new Listener(MyListener::class),
    /**
     * Adding route
     * via config.
     */
    (new Route(MyRoutes::MY))->setLiteral('/my-route'),
]);

Webino::application($config)->bootstrap()->dispatch();
