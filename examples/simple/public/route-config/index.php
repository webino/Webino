<?php
/**
 * Route Config
 * Webino example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Feature\Listener;
use WebinoAppLib\Listener\RouteListenerTrait;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;
use WebinoBaseLib\Html\TextHtml;
use WebinoConfigLib\Feature\Route;
use WebinoEventLib\AbstractListener;

require __DIR__ . '/../../vendor/autoload.php';

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
            $event->setResponseContent([
                new TextHtml('Hello Webino!'),
                $event->getApp()->url('myRoute')->html('Go to MyRoute'),
                new SourcePreview(__FILE__),
            ]);
        });

        /**
         * Handling custom route.
         */
        $this->listenRoute('myRoute', function (RouteEvent $event) {
            $event->setResponseContent([
                new TextHtml('My Route Example!'),
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
    (new Route('myRoute'))->setLiteral('/my-route'),
]);

Webino::application($config)->bootstrap()->dispatch();
