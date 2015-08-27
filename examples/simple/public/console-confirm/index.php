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
        new TextHtml('Use Command Line Interface!'),
        new ConsolePreviewHtml('preview.gif'),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
