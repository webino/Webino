<?php
/**
 * Console Command
 * Webino example
 */

use WebinoAppLib\Event\ConsoleEvent;
use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;
use WebinoConfigLib\Feature\Route\Console;

require __DIR__ . '/../../vendor/autoload.php';

$config = Webino::config([
    /**
     * Configuring custom
     * console command.
     */
    (new Console('myCommand'))
        ->setRoute('my-command')
        ->setTitle('My command title')
        ->setDescription('My command description.'),
]);

$app = Webino::application($config)->bootstrap();

/**
 * Binding to custom
 * console command.
 */
$app->bindConsole('myCommand', function (ConsoleEvent $event) {
    $event->getCli()->out('My custom command example!');
});

// TODO literal parameters example
// TODO literal flags example
// TODO positional value parameters example
// TODO value flags parameters example
// TODO parameter groups example

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    $event->setResponseContent([
        'Use Command Line Interface!',
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
