<?php
/**
 * Console Bind
 * Webino example
 */

use WebinoAppLib\Event\ConsoleEvent;
use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;
use WebinoConfigLib\Feature\Route\Console;
use WebinoExamplesLib\Html\ConsolePreviewHtml;
use WebinoHtmlLib\TextHtml;

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
    $cli = $event->getCli();
    $cli->out('My custom command example!')->br();
});

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    $event->setResponseContent([
        new TextHtml('Use Command Line Interface!'),
        new ConsolePreviewHtml('preview.jpg'),
        new ConsolePreviewHtml('preview-command.jpg', 'Console command preview:'),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();