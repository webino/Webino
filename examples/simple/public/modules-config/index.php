<?php
/**
 * Modules Config
 * Webino example
 */

use WebinoAppLib\Application\AbstractApplication;
use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Feature\Config;
use WebinoAppLib\Feature\Modules;
use WebinoAppLib\Feature\Service;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;

require __DIR__ . '/../../vendor/autoload.php';

/**
 * Custom module
 */
class MyModule
{
    public function __invoke(AbstractApplication $app)
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

            $event->setResponseContent([
                $myService->doSomething(),
                new SourcePreview(__FILE__),
            ]);
        });

        /**
         * The Configure event will be triggered
         * only when the application configuration
         * is not loaded from a cache.
         */
        $app->onConfig(function () {
            return [
                new Service(MyModuleService::class),
            ];
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

Webino::application($config)->bootstrap()->dispatch();
