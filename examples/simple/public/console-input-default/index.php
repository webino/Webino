<?php
/**
 * Console Input Default
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
         * The console input
         * default example.
         */
        $cli    = $event->getCli();
        $input  = $cli->input('How you doin?')->defaultTo('Great!');
        $result = $input->prompt();

        $cli->br()->out("The answer is: <bold>$result</bold>")->br();
    }
}

$config = Webino::config([
    new MyConsoleCommand,
]);

$app = Webino::application($config)->bootstrap();

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    $event->setResponse([
        new Html\Text('Use Command Line Interface!'),
        new ConsolePreview('preview.gif'),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
