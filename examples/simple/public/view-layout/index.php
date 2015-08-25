<?php
/**
 * Render Html Listener
 * Webino example
 */

use WebinoAppLib\Application\AbstractApplication;
use WebinoAppLib\Application\CoreConfig;
use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;

require __DIR__ . '/../../vendor/autoload.php';

$config = new CoreConfig([

]);

$app = Webino::application($config)->bootstrap();

//$app->bind();

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    $event->setResponseContent([
        'Hello Webino!',
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
