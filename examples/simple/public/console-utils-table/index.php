<?php
/**
 * Console Utils Table
 * Webino example
 */

use WebinoAppLib\Console\AbstractConsoleCommand;
use WebinoAppLib\Event\ConsoleEvent;
use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;
use WebinoConfigLib\Feature\Route\Console;

require __DIR__ . '/../../vendor/autoload.php';

class MyConsoleCommand extends AbstractConsoleCommand
{
    public function configure(Console $console)
    {
        $console->setRoute('my-command');
    }

    /**
     * The console table
     * utility example.
     */
    public function handle(ConsoleEvent $event)
    {
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

        $event->getCli()->table($data)->br();
    }
}

$config = Webino::config([
    new MyConsoleCommand,
]);

$app = Webino::application($config)->bootstrap();

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    $event->setResponseContent([
        'Use Command Line Interface!',
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
