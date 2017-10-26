<?php
/**
 * Console Columns
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
     * columns example.
     */
    public function handle(ConsoleEvent $event)
    {
        $cli = $event->getCli();

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

        $cli->columns($data)->br();


        $data = [
            ['Gary', 'Mary', 'Larry', 'Terry'],
            [1.2, 4.3, 0.1, 3.0],
            [6.6, 4.4, 5.5, 3.3],
            [9.1, 8.2, 7.3, 6.4],
        ];

        $cli->columns($data)->br();
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
