<?php
/**
 * Console Bind
 * Webino Example
 */

use WebinoAppLib\Event\ConsoleEvent;
use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;
use WebinoConfigLib\Feature\Route\ConsoleRoute;
use WebinoExamplesLib\Html\ConsolePreview;
use WebinoHtmlLib\Html;

require __DIR__ . '/../../vendor/autoload.php';

abstract class MyCommands
{
    const MY = 'myCommand';
}

$config = Webino::config([
    /**
     * Configuring custom
     * console command.
     */
    (new ConsoleRoute(MyCommands::MY))
        ->setPath('my-command')
        ->setTitle('My command title')
        ->setDescription('My command description.'),
]);

$app = Webino::application($config)->bootstrap();

/**
 * Binding to custom
 * console command.
 */
$app->bindConsole(MyCommands::MY, function (ConsoleEvent $event) {
    $event->getCli()->out('My custom command example!')->br();
});

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    $event->setResponse([
        new Html\Text('Use Command Line Interface!'),
        new ConsolePreview('preview.jpg'),
        new ConsolePreview('preview-command.jpg', 'Console Command Preview'),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
