<?php
/**
 * Modules Debugger
 * Webino example
 */

use WebinoAppLib\Application\AbstractApplication;
use WebinoAppLib\Debugger\Bar\AbstractPanel;
use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Feature\DebugBarInfo;
use WebinoAppLib\Feature\DebugBarPanel;
use WebinoAppLib\Feature\Modules;
use WebinoAppLib\Module\AbstractModule;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;
use WebinoHtmlLib\Html;

require __DIR__ . '/../../vendor/autoload.php';

/**
 * Custom module
 */
class MyModule extends AbstractModule
{
    const VERSION = '0.1.0';

    public function init(AbstractApplication $app)
    {
        /**
         * Binding to default route
         * from the custom module.
         */
        $app->bind(DefaultRoute::class, function (RouteEvent $event) {
            $event->setResponseContent([
                'Check out right bottom corner > TRACY!',
                new SourcePreview(__FILE__),
            ]);
        });
    }

    public function getConfig()
    {
        return [
            /**
             * Configuring the Tracy
             * debugger bar info.
             */
            new DebugBarInfo('MyModule', $this::VERSION),
            /**
             * Configuring the Tracy
             * debugger bar panel.
             */
            new DebugBarPanel(MyDebugBarPanel::NAME, MyDebugBarPanel::class),
        ];
    }
}

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
        return new Html\Title('My Module Debugger Bar Panel Example');
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

$debugger = Webino::debugger(Webino::debuggerOptions()->setDevMode()->setBar());

Webino::application($config, $debugger)->bootstrap()->dispatch();
