<?php
/**
 * Modules Console Command
 * Webino example
 */

use WebinoAppLib\Application\AbstractApplication;
use WebinoAppLib\Console\AbstractConsoleCommand;
use WebinoAppLib\Event\ConsoleEvent;
use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Feature\Modules;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;
use WebinoConfigLib\Feature\Route\Console;

require __DIR__ . '/../../vendor/autoload.php';

/**
 * Custom console command
 */
class MyConsoleCommand extends AbstractConsoleCommand
{
    public function configure(Console $console)
    {
        $console
            ->setRoute('my-command')
            ->setTitle('My command title');
    }

    public function handle(ConsoleEvent $event)
    {
        $event->getCli()->out('My custom module console command!')->br();
    }
}

/**
 * Custom module
 */
class MyModule
{
    public function __invoke(AbstractApplication $app)
    {
        $app->bind(DefaultRoute::class, function (RouteEvent $event) {
            $event->setResponseContent([
                'Use Command Line Interface!',
                new SourcePreview(__FILE__),
            ]);
        });

        $app->onConfig(function () {
            return [
                /**
                 * Configuring custom
                 * console command.
                 */
                new MyConsoleCommand,
            ];
        });
    }
}

$config = Webino::config([
    /**
     * Configuring app
     * modules.
     */
    new Modules([
        MyModule::class,
    ]),
]);

Webino::application($config)->bootstrap()->dispatch();
