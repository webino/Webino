<?php
/**
 * Console Progress Labels
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
     * The console progress
     * labels example.
     */
    public function handle(ConsoleEvent $event)
    {
        $cli = $event->getCli();
        $items = [
            'php',
            'javascript',
            'python',
            'ruby',
            'java',
        ];

        $progress = $cli->progress(count($items));

        foreach ($items as $key => $value) {
            $progress->current($key + 1, $value);

            // simulate something happening
            usleep(rand(100000, 3000000));
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
