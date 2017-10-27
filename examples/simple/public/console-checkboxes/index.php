<?php
/**
 * Console Checkboxes
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

    /**
     * The console checkboxes example
     *
     * @param ConsoleEvent $event
     */
    public function handle(ConsoleEvent $event)
    {
        $cli = $event->getCli();

        $options = ['Ice Cream', 'Mixtape', 'Teddy Bear', 'Pizza', 'Puppies'];
        $input   = $cli->checkboxes('Please send me all of the following:', $options);
        $result  = $input->prompt();

        $cli
            ->br()
            ->inline('The answer is: ')
            ->bold($result ? join(', ', $result) : 'none')
            ->br();
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
