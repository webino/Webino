<?php
/**
 * Console Formatting
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

class ConsoleFormatsExample extends AbstractConsoleCommand
{
    public function configure(Console $console)
    {
        $console
            ->setRoute('formats-example')
            ->setTitle('Run console formats example');
    }

    /**
     * The console
     * formatting example.
     */
    public function handle(ConsoleEvent $event)
    {
        $cli = $event->getCli();

        $cli
            ->out('● Colors:')->br()
            ->black('Black text!')
            ->red('Red text!')
            ->green('Green text!')
            ->yellow('Yellow text!')
            ->blue('Blue text!')
            ->magenta('Magenta text!')
            ->cyan('Cyan text!')
            ->lightGray('Light gray text!')
            ->darkGray('Dark gray text!')
            ->lightRed('Light red text!')
            ->lightGreen('Light green text!')
            ->lightYellow('Light yellow text!')
            ->lightBlue('Light blue text!')
            ->lightMagenta('Light magenta text!')
            ->lightCyan('Light cyan text!')
            ->white('White text!');

        $cli
            ->br(2)->out('● Background Colors:')->br()
            ->backgroundBlack('Text on black background!')
            ->backgroundRed('Text on red background!')
            ->backgroundGreen('Text on green background!')
            ->backgroundYellow('Text on yellow background!')
            ->backgroundBlue('Text on blue background!')
            ->backgroundMagenta('Text on magenta background!')
            ->backgroundCyan('Text on cyan background!')
            ->backgroundLightGray('Text on light gray background!')
            ->backgroundDarkGray('Text on dark gray background!')
            ->backgroundLightRed('Text on light red background!')
            ->backgroundLightGreen('Text on light green background!')
            ->backgroundLightYellow('Text on light yellow background!')
            ->backgroundLightBlue('Text on light blue background!')
            ->backgroundLightMagenta('Text on light magenta background!')
            ->backgroundLightCyan('Text on light cyan background!')
            ->backgroundWhite('Text on white background!');

        $cli
            ->br(2)->out('● Text Style:')->br()
            ->bold('Bold text!')
            ->dim('Dim text!')
            ->underline('Underlined text!')
            ->invert('Inverted text!');

        $cli
            ->br(2)->out('● Style Commands:')->br()
            ->info('Info text style!')
            ->comment('Comment text style!')
            ->whisper('Whisper text style!')
            ->shout('Shout text style!')
            ->error('Error text style!');

        $cli->br();
    }
}

$config = Webino::config([
    new ConsoleFormatsExample,
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
