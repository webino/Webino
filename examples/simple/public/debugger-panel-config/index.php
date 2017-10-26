<?php
/**
 * Debugger Panel via Config
 * Webino example
 */

use WebinoAppLib\Debugger\Bar\AbstractPanel;
use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Feature\DebugBarPanel;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;
use WebinoHtmlLib\Html;

require __DIR__ . '/../../vendor/autoload.php';

/**
 * Debugger bar panel
 */
class MyDebugBarPanel extends AbstractPanel
{
    const NAME = 'myPanel';

    protected function getDir()
    {
        return __DIR__ . '/' . $this::RESOURCES;
    }

    protected function getLabel()
    {
        return 'MyPanel';
    }

    protected function getTitle()
    {
        return 'My Debugger Bar Panel';
    }

    public function getTab()
    {
        return $this->createIcon('user', ['top' => '-3px']) . parent::getTab();
    }

    public function getPanel()
    {
        return new Html\Title('My Debugger Bar Panel Example');
    }
}

/**
 * Adding the Tracy
 * debugger bar.
 */
$debugger = Webino::debugger(Webino::debuggerOptions()->setDevMode()->setBar());

$config = Webino::config([
    /**
     * Configuring the Tracy
     * debugger bar panel.
     */
    new DebugBarPanel(MyDebugBarPanel::NAME, MyDebugBarPanel::class),
]);

$app = Webino::application($config, $debugger)->bootstrap();

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    $event->setResponseContent([
        'Check out right bottom corner > MyPanel!',
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
