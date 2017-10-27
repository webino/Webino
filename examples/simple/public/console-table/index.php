<?php
/**
 * Console Table
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
         * The console
         * table example.
         */
        $cli = $event->getCli();

        $data = [
            [
              'Walter White',
              'Father',
              'Teacher',
            ],
            [
              'Skyler White',
              'Mother',
              'Accountant',
            ],
            [
              'Walter White Jr.',
              'Son',
              'Student',
            ],
        ];

        $cli->table($data)->br();

        /**
         * Table with
         * column names.
         */
        $data = [
            [
                'name'       => 'Walter White',
                'role'       => 'Father',
                'profession' => 'Teacher',
            ],
            [
                'name'       => 'Skyler White',
                'role'       => 'Mother',
                'profession' => 'Accountant',
            ],
            [
                'name'       => 'Walter White Jr.',
                'role'       => 'Son',
                'profession' => 'Student',
            ],
        ];

        $cli->table($data)->br();
    }
}

$config = Webino::config([
    new MyConsoleCommand,
]);

$app = Webino::application($config)->bootstrap();

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    $event->setResponse([
        new Html\Text('Use Command Line Interface!'),
        (new ConsolePreview('preview.jpg'))->setHeight(400),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
