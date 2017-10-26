<?php
/**
 * Console Border
 * Webino example
 */

use WebinoAppLib\Console\AbstractConsoleCommand;
use WebinoAppLib\Event\ConsoleEvent;
use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;
use WebinoConfigLib\Feature\Route\Console;
use WebinoExamplesLib\Html\ConsolePreview;
use WebinoHtmlLib\Html;

require __DIR__ . '/../../vendor/autoload.php';

class MyConsoleCommand extends AbstractConsoleCommand
{
    public function configure(Console $console)
    {
        $console->setRoute('my-command');
    }

    /**
     * The console
     * border example.
     */
    public function handle(ConsoleEvent $event)
    {
        $cli = $event->getCli();

        $cli->border()->br();

        $cli->border('*')->br();

        $cli->border('#', 10)->br();
    }
}

$config = Webino::config([
    new MyConsoleCommand,
]);

$app = Webino::application($config)->bootstrap();

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    $event->setResponseContent([
        new Html\Text('Use Command Line Interface!'),
        new ConsolePreview('preview.jpg'),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
