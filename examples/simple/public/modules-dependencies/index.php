<?php
/**
 * Modules Dependencies
 * Webino Example
 */

use WebinoAppLib\Application\AbstractApplication;
use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Feature\Modules;
use WebinoAppLib\Feature\Service;
use WebinoAppLib\Module\AbstractModule;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;

require __DIR__ . '/../../vendor/autoload.php';

/**
 * Custom base module
 */
class MyModuleBase extends AbstractModule
{
    public function getConfig()
    {
        return [
            new Service(MyModuleService::class),
        ];
    }
}

/**
 * Custom module
 */
class MyModule extends AbstractModule
{
    const VERSION = '0.1.0';

    public function getDependencies()
    {
        return [
            MyModuleBase::class,
        ];
    }

    protected function init(AbstractApplication $app)
    {
        /**
         * Binding to default route
         * from the custom module.
         */
        $app->bind(DefaultRoute::class, function (RouteEvent $event) {
            /**
             * Obtaining custom
             * module service.
             */
            $myService = $event->getApp()->get(MyModuleService::class);

            $event->setResponse([
                $myService->doSomething(),
                new SourcePreview(__FILE__),
            ]);
        });
    }
}

/**
 * Custom module service
 */
class MyModuleService
{
    public function doSomething()
    {
        return 'My custom module response text!';
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
