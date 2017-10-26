<?php
/**
 * Console Table
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
     * table example.
     */
    public function handle(ConsoleEvent $event)
    {
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
    $event->setResponseContent([
        new Html\Text('Use Command Line Interface!'),
        (new ConsolePreview('preview.jpg'))->setHeight(400),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
