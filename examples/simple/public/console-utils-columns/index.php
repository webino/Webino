<?php
/**
 * Console Utils Columns
 * Webino example
 */

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
     * The console columns
     * utility example.
     */
    public function handle(ConsoleEvent $event)
    {
        $data = [
            '12 Monkeys',
            '12 Years a Slave',
            'A River Runs Through It',
            'Across the Tracks',
            'Babel',
            'Being John Malkovich',
            'Burn After Reading',
            'By the Sea',
            'Confessions of a Dangerous Mind',
            'Contact',
            'Cool World',
            'Cutting Class',
            'Fight Club',
            'Fury',
            'Happy Feet Two',
            'Happy Together',
            'Hunk',
            'Inglourious Basterds',
            'Interview with the Vampire',
            'Johnny Suede',
            'Kalifornia',
            'Killing Them Softly',
            'Legends of the Fall',
            'Less Than Zero',
            'Meet Joe Black',
            'Megamind',
            'Moneyball',
        ];

        $event->getCli()->columns($data)->br();
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
