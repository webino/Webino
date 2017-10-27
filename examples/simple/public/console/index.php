<?php
/**
 * Console
 * Webino Example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;
use WebinoExamplesLib\Html\ConsolePreview;
use WebinoHtmlLib\Html\Text;

require __DIR__ . '/../../vendor/autoload.php';

$app = Webino::application()->bootstrap();

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    $event->setResponse([
        new Text('Use Command Line Interface!'),
        new ConsolePreview('preview.jpg'),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
