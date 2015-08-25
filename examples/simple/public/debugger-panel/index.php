<?php
/**
 * Debugger Panel
 * Webino example
 */

use WebinoAppLib\Debugger\Bar\AbstractPanel;
use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Feature\DebugBarPanel;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;
use WebinoHtmlLib\TitleHtml;

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
        return new TitleHtml('My Debugger Bar Panel Example');
    }
}

/**
 * Adding the Tracy
 * debugger bar.
 */
$debugger = Webino::debugger(Webino::debuggerOptions()->setDevMode()->setBar());

$app = Webino::application(null, $debugger)->bootstrap();

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    /**
     * Adding the Tracy
     * debugger bar panel.
     */
    $event->getApp()->debug()->setBarPanel(new MyDebugBarPanel, MyDebugBarPanel::NAME);

    $event->setResponseContent([
        'Check out right bottom corner > MyPanel!',
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
