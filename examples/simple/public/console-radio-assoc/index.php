<?php
/**
 * Console Radio Assoc
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
         * The console radio
         * assoc example.
         */
        $cli = $event->getCli();

        $options = [
            'option1' => 'Ice Cream',
            'option2' => 'Mixtape',
            'option3' => 'Teddy Bear',
            'option4' => 'Pizza',
            'option5' => 'Puppies'
        ];

        $input  = $cli->radio('Please send me one of the following:', $options);
        $result = $input->prompt();

        $cli
            ->br()->inline('The answer is: ')
            ->bold($result ?: 'none')->br();
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
