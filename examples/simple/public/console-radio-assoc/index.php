<?php
/**
 * Console Radio Assoc
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
     * The console radio
     * assoc example.
     */
    public function handle(ConsoleEvent $event)
    {
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

        $cli->br()->out("The answer is: <bold>$result</bold>")->br();
    }
}

$config = Webino::config([
    new MyConsoleCommand,
]);

$app = Webino::application($config)->bootstrap();

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    $event->setResponseContent([
        new Html\Text('Use Command Line Interface!'),
        new ConsolePreview('preview.gif'),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
