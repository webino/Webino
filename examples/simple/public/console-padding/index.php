<?php
/**
 * Console Padding
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
         * The console
         * padding example.
         */
        $cli = $event->getCli();
        $padding = $cli->padding(20);

        $padding->label('Eggs')->result('1.99€');
        $padding->label('Oatmeal')->result('4.99€');
        $padding->label('Bacon')->result('2.99€');

        $cli->br(2);

        $padding = $cli->padding(30, '-');

        $padding->label('Eggs')->result('1.99€');
        $padding->label('Oatmeal')->result('4.99€');
        $padding->label('Bacon')->result('2.99€');

        $cli->br();
    }
}

$config = Webino::config([
    new MyConsoleCommand,
]);

$app = Webino::application($config)->bootstrap();

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    $event->setResponse([
        new Html\Text('Use Command Line Interface!'),
        new ConsolePreview('preview.jpg'),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
