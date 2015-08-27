<?php
/**
 * Console Flank
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
     * flank example.
     */
    public function handle(ConsoleEvent $event)
    {
        $cli = $event->getCli();

        $cli->flank('Look at me. Now.');

        // specifying the flanking characters
        $cli->flank('Look at me. Now.', '!');

        // and how many flanking characters there should be
        $cli->flank('Look at me. Now.', '!', 5);

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
        new ConsolePreviewHtml('preview.jpg'),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
