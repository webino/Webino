<?php

//use Webino\Config;
//use Webino\Feature;
//use Webino\Feature\ThrowEmptyResponseException;
//use Webino\Markdown\Feature\Markdown;
use WebinoAppLib\Application\CoreConfig;
use WebinoAppLib\Feature as AppFeature;
use WebinoAppLib\Listener\RoutingListener;
use WebinoAppLib\Router\DefaultRoute;
use WebinoConfigLib\Feature as ConfigFeature;
use WebinoDrawLib\Feature\CommonDraw;
use WebinoDrawLib\Feature\NodeDraw;
use WebinoDrawLib\Feature\TableDraw;

class MyCoreListener extends \WebinoEventLib\AbstractListener
{
    /**
     * Initialize listener
     */
    protected function init()
    {
        $this->listen(\WebinoAppLib\Event\AppEvent::BOOTSTRAP, 'onBootstrap');
    }

    public function onBootstrap()
    {
//        die('HELLO');
    }
}

return new CoreConfig([
//    new ConfigFeature\Log,
//    new ConfigFeature\FirePhpLog,
//    new ConfigFeature\ConfigCacheEnabled,
    new AppFeature\FilesystemCache,

    ['responseText' => 'Random: ' . rand(9, 9999)],

    new AppFeature\CoreListener(MyCoreListener::class),

    (new ConfigFeature\Route(DefaultRoute::class))
        ->setLiteral('/'),

    new CommonDraw([
        (new TableDraw('test-table'))->setLocator('.side-column')->setHtml('{$_innerHtml}{$_table}')->setOptions(['data' => 'exampleData']),

        (new TableDraw('test-table2'))->setLocator('.side-column')->setHtml('{$_innerHtml}{$_table}')->setOptions(['data' => 'exampleData2']),

        (new TableDraw('test-table3'))->setLocator('.content')->setHtml('{$_innerHtml}{$_table}')->setOptions(['data' => 'exampleData']),

        (new NodeDraw('test-draw01'))->setLocator('tr[1] td[1]')->setValue('pokusx'),

        (new NodeDraw('test-draw02'))->setLocator('a')->setValue('Click me!'),
    ]),
]);

//return new Config([
//    new ConfigCacheEnabled(false), // TODO local config only
//    new Markdown, // TODO local config only
//    new ThrowEmptyResponseException(false),
//]);













//
//
//
//return new Config([
//    'config_cache_enabled' => false,
//
//    new Modules([
//        'WelcomeModule',
//        'ExampleModule',
//    ]),
//
//    new Markdown,
//
//    (new Route\Regex(['default', '(?<path>(/[^\.]*))'], '%path%', 'WelcomeModule\Action\Home'))
//        ->setChilds([
//            (new Route(['json', '.json']))
//                ->setDefaults(['format' => 'json', 'useLayout' => false]),
//
//            (new Route(['xml', '.xml']))
//                ->setDefaults(['format' => 'xml']),
//
//            new Route(['catchall', '']),
//        ]),
//
//    // Override example
//    //(new Route\Regex(['default']))
//    //    ->setChild((new Route(['json']))->setDefaults(['useLayout' => true])),
//
//    // TODO console help
//    // php index.php test command
////    new Console\Route('test command', function () {
////        return PHP_EOL . 'CONSOLE TEST COMMAND' . PHP_EOL . PHP_EOL;
////    }),
//]);
