<?php
/**
 * Console Progress Manually
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
     * The console progress
     * manually example.
     */
    public function handle(ConsoleEvent $event)
    {
        $cli = $event->getCli();
        $progress = $cli->progress(20);

        // simulate something happening
        sleep(1);

        $progress->advance();

        // simulate something happening
        sleep(4);

        $progress->advance(10);

        // simulate something happening
        sleep(2);

        $progress->advance(5, 'Still going.');

        // simulate something happening
        sleep(1);

        $progress->advance(4);

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
        new ConsolePreview('preview.gif'),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
