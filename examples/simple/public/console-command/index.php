<?php
/**
 * Console Command
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

/**
 * Custom console command class
 */
class MyConsoleCommand extends AbstractConsoleCommand
{
    public function configure(ConsoleRoute $route)
    {
        $route
            ->setPath([
                'my-command',
                '(requiredArgumentA|requiredArgumentB)',
                '<requiredArgumentValue> [<optionalArgumentValue>]',
                '[optionalArgumentA|optionalArgumentB]',
                '(--requiredOptionA|--requiredOptionB) [--optionalOption|-o]',
                '--requiredOptionValue= [--optionalOptionValue=]',
            ])
            ->setTitle('My command title')
            ->setDescription([
                'This is a full featured console command example.',
                'Try following commands:',
                'my-command requiredArgumentA myArgumentValueA --requiredOptionA --requiredOptionValue=myOptionValueA',
                'my-command requiredArgumentB myArgumentValueB --requiredOptionB --requiredOptionValue=myOptionValueB',
                'my-command requiredArgumentA myArgumentValueA myArgumentValueB optionalArgumentA --requiredOptionA '
                . '--optionalOption --requiredOptionValue=myOptionValueA --optionalOptionValue=myOptionValueB',
                'my-command requiredArgumentA myArgumentValueA myArgumentValueB optionalArgumentB --requiredOptionA '
                . '-o --requiredOptionValue=myOptionValueA --optionalOptionValue=myOptionValueB',
            ])
            ->setArgumentsDescription([
                'requiredArgumentA'     => 'Enter this or requiredArgumentB',
                'requiredArgumentB'     => 'Enter this or requiredArgumentA',
                'requiredArgumentValue' => 'Enter custom argument value',
                'optionalArgumentValue' => 'Optionally enter this custom value',
                'optionalArgumentA'     => 'Optionally enter this or optionalArgumentB',
                'optionalArgumentB'     => 'Optionally enter this or optionalArgumentA',
            ])
            ->setOptionsDescription([
                'requiredOptionA'      => 'Enter this or --requiredOptionB',
                'requiredOptionB'      => 'Enter this or --requiredOptionA',
                'optionalOption (-o)'  => 'Optionally enter this option or use short alternative',
                'requiredOptionValue=' => 'Enter custom option value',
                'optionalOptionValue=' => 'Optionally enter this option value',
            ]);
    }

    public function handle(ConsoleEvent $event)
    {
        $cli = $event->getCli();
        $cli->out('My custom command example!');

        $cli->br()->yellow()->bold('Arguments:');

        $cli->green()->inline(' requiredArgumentA: ');
        $cli->out($event->getParam('requiredArgumentA') ? 'yes' : 'no');

        $cli->green()->inline(' requiredArgumentB: ');
        $cli->out($event->getParam('requiredArgumentB') ? 'yes' : 'no');

        $cli->green()->inline(' requiredArgumentValue: ');
        $cli->out($event->getParam('requiredArgumentValue'));

        $cli->green()->inline(' optionalArgumentValue: ');
        $cli->out($event->getParam('optionalArgumentValue', 'none'));

        $cli->green()->inline(' optionalArgumentA: ');
        $cli->out($event->getParam('optionalArgumentA') ? 'yes' : 'no');

        $cli->green()->inline(' optionalArgumentB: ');
        $cli->out($event->getParam('optionalArgumentB') ? 'yes' : 'no');

        $cli->br()->yellow()->bold('Options:');

        $cli->green()->inline(' --requiredOptionA: ');
        $cli->out($event->getParam('requiredOptionA') ? 'yes' : 'no');

        $cli->green()->inline(' --requiredOptionB: ');
        $cli->out($event->getParam('requiredOptionB') ? 'yes' : 'no');

        $cli->green()->inline(' --optionalOption: ');
        $cli->out($event->getParam('optionalOption') ? 'yes' : 'no');

        $cli->green()->inline(' --requiredOptionValue: ');
        $cli->out($event->getParam('requiredOptionValue'));

        $cli->green()->inline(' --optionalOptionValue: ');
        $cli->out($event->getParam('optionalOptionValue', 'none'));

        $cli->br();
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
    $event->setResponse([
        new Html\Text('Use Command Line Interface!'),
        new ConsolePreview('preview.jpg'),
        new ConsolePreview('preview-command-help.jpg', 'Console Command Help Preview'),
        new ConsolePreview('preview-command.jpg', 'Console Command Preview'),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
