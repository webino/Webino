<?php
/**
 * Console Formatting
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

class ConsoleFormatsExample extends AbstractConsoleCommand
{
    public function configure(ConsoleRoute $route)
    {
        $route
            ->setPath('formats-example')
            ->setTitle('Run console formats example');
    }

    public function handle(ConsoleEvent $event)
    {
        /**
         * The console
         * formatting example.
         */
        $event->getCli()
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
            ->white('White text!')

            ->br(2)->out('● Background Colors:')->br()
            ->blackBg('Text on black background!')
            ->redBg('Text on red background!')
            ->greenBg('Text on green background!')
            ->yellowBg('Text on yellow background!')
            ->blueBg('Text on blue background!')
            ->magentaBg('Text on magenta background!')
            ->cyanBg('Text on cyan background!')
            ->lightGrayBg('Text on light gray background!')
            ->darkGrayBg('Text on dark gray background!')
            ->lightRedBg('Text on light red background!')
            ->lightGreenBg('Text on light green background!')
            ->lightYellowBg('Text on light yellow background!')
            ->lightBlueBg('Text on light blue background!')
            ->lightMagentaBg('Text on light magenta background!')
            ->lightCyanBg('Text on light cyan background!')
            ->whiteBg('Text on white background!')

            ->br(2)->out('● Text Style:')->br()
            ->bold('Bold text!')
            ->dim('Dim text!')
            ->underline('Underlined text!')
            ->invert('Inverted text!')

            ->br(2)->out('● Style Commands:')->br()
            ->info('Info text style!')
            ->comment('Comment text style!')
            ->whisper('Whisper text style!')
            ->shout('Shout text style!')
            ->error('Error text style!')

            ->br();
    }
}

$config = Webino::config([
    new ConsoleFormatsExample,
]);

$app = Webino::application($config)->bootstrap();

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    $event->setResponse([
        new Html\Text('Use Command Line Interface!'),
        (new ConsolePreview('preview.jpg'))->setHeight(400),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
