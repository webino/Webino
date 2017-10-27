<?php
/**
 * Route Bind Invokable Class
 * Webino Example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;
use Zend\ModuleManager\Listener\AbstractListener;

require __DIR__ . '/../../vendor/autoload.php';

/**
 * Custom invokable listener
 */
class MyListener
{
    public function __invoke(RouteEvent $event)
    {
        $event->setResponse(['Hello Webino!', new SourcePreview(__FILE__)]);
    }
}

$app = Webino::application()->bootstrap();

/**
 * Handling default route
 * via invokable listener class.
 */
$app->bind(DefaultRoute::class, MyListener::class);

$app->dispatch();
