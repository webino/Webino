<?php
/**
 * Console Add Art
 * Webino example
 */

use WebinoAppLib\Console\AbstractConsoleCommand;
use WebinoAppLib\Event\ConsoleEvent;
use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;
use WebinoConfigLib\Feature\Route\Console;
use WebinoExamplesLib\Html\ConsolePreviewHtml;
use WebinoHtmlLib\TextHtml;

require __DIR__ . '/../../vendor/autoload.php';

class MyConsoleCommand extends AbstractConsoleCommand
{
    public function configure(Console $console)
    {
        $console->setRoute('my-command');
    }

    /**
     * The console custom
     * art example.
     */
    public function handle(ConsoleEvent $event)
    {
        $event->getCli()->addArt(__DIR__ . '/art')->greenView('hemp');
    }
}

$config = Webino::config([
    new MyConsoleCommand,
]);

$app = Webino::application($config)->bootstrap();

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    $event->setResponseContent([
        new TextHtml('Use Command Line Interface!'),
        (new ConsolePreviewHtml('preview.jpg'))->setHeight(400),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
