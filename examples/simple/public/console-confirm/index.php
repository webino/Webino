<?php
/**
 * Console Confirm
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
     * confirm example.
     */
    public function handle(ConsoleEvent $event)
    {
        $cli = $event->getCli();

        $input = $cli->confirm('Continue?');

        if ($input->confirmed()) {
            $cli->br()->out('Continuing...');
        }

        $cli->br();
    }
}

$config = Webino::config([
    new MyConsoleCommand,
]);

$app = Webino::application($config)->bootstrap();

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    $event->setResponseContent([
        new Html\Text('Use Command Line Interface!'),
        new Html\ConsolePreview('preview.gif'),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
