<?php
/**
 * Route Bind Aggregate Object
 * Webino Example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;
use WebinoEventLib\AbstractListener;

require __DIR__ . '/../../vendor/autoload.php';

/**
 * Custom listener aggregate
 */
class MyListener extends AbstractListener
{
    protected function init()
    {
        /**
         * Handling default route.
         */
        $this->listen(DefaultRoute::class, function (RouteEvent $event) {
            $event->setResponse(['Hello Webino!', new SourcePreview(__FILE__)]);
        });
    }
}

$app = Webino::application()->bootstrap();

/**
 * Binding listener
 * aggregate object.
 */
$app->bind(new MyListener);

$app->dispatch();
