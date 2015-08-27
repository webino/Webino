<?php
/**
 * Console Padding
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
     * padding example.
     */
    public function handle(ConsoleEvent $event)
    {
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
    $event->setResponseContent([
        new TextHtml('Use Command Line Interface!'),
        new ConsolePreviewHtml('preview.jpg'),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
