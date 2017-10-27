<?php
/**
 * Console Add Art
 * Webino Example
 */

use WebinoAppLib\Console\AbstractConsoleCommand;
use WebinoAppLib\Event\ConsoleEvent;
use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;
use WebinoConfigLib\Feature\Route\ConsoleRoute;
use WebinoExamplesLib\Html\ConsolePreview;
use WebinoHtmlLib\Html;

require __DIR__ . '/../../vendor/autoload.php';

class MyConsoleCommand extends AbstractConsoleCommand
{
    public function configure(ConsoleRoute $route)
    {
        $route->setPath('my-command');
    }

    public function handle(ConsoleEvent $event)
    {
        /**
         * The console custom
         * art example.
         */
        $event
            ->getCli()
            ->addArt(__DIR__ . '/art')
            ->green()
            ->draw('hemp');
    }
}

$config = Webino::config([
    new MyConsoleCommand,
]);

$app = Webino::application($config)->bootstrap();

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    $event->setResponse([
        new Html\Text('Use Command Line Interface!'),
        (new ConsolePreview('preview.jpg'))->setHeight(400),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
