<?php
/**
 * Console Command Class
 * Webino example
 */

use WebinoAppLib\Console\AbstractConsoleCommand;
use WebinoAppLib\Event\ConsoleEvent;
use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;
use WebinoConfigLib\Feature\Route\Console;

require __DIR__ . '/../../vendor/autoload.php';

/**
 * Custom console command class
 */
class MyConsoleCommand extends AbstractConsoleCommand
{
    /**
     * @inheritDoc
     */
    public function configure(Console $console)
    {
        $console
            ->setRoute('my-command')
            ->setTitle('My command title')
            ->setDescription('My command description.');
    }

    /**
     * @inheritDoc
     */
    public function handle(ConsoleEvent $event)
    {
        $event->getCli()->out('My custom command example!');
    }
}

$config = Webino::config([
    /**
     * Configuring custom
     * console command.
     */
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
