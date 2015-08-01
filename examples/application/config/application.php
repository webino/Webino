<?php

//use Webino\Config;
//use Webino\Feature;
//use Webino\Feature\ThrowEmptyResponseException;
//use Webino\Markdown\Feature\Markdown;
use WebinoAppLib\Application\CoreConfig;
use WebinoAppLib\Feature as AppFeature;
use WebinoConfigLib\Feature as ConfigFeature;

return new CoreConfig([
    new ConfigFeature\Log,
    new ConfigFeature\FirePhpLog,
    new ConfigFeature\ConfigCacheEnabled,
    new AppFeature\FilesystemCache,

    ['responseText' => 'Random: ' . rand(9, 9999)],
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
