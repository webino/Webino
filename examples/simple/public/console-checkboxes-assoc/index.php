<?php
/**
 * Console Checkboxes Assoc
 * Webino example
 */

use WebinoAppLib\Console\AbstractConsoleCommand;
use WebinoAppLib\Event\ConsoleEvent;
use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;
use WebinoConfigLib\Feature\Route\Console;
use WebinoExamplesLib\Html\ConsolePreviewHtml;
use WebinoHtmlLib\TextHtml;

require __DIR__ . '/../../vendor/autoload.php';

class MyConsoleCommand extends AbstractConsoleCommand
{
    public function configure(Console $console)
    {
        $console->setRoute('my-command');
    }

    /**
     * The console checkboxes
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

        $input  = $cli->checkboxes('Please send me all of the following:', $options);
        $result = $input->prompt();

        $cli->br()->out('The answer is: <bold>' . join(', ', $result) . '</bold>')->br();
    }
}

$config = Webino::config([
    new MyConsoleCommand,
]);

$app = Webino::application($config)->bootstrap();

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    $event->setResponseContent([
        new TextHtml('Use Command Line Interface!'),
        new ConsolePreviewHtml('preview.gif'),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
