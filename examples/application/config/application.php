<?php

//use Webino\Config;
//use Webino\Feature;
//use Webino\Feature\ThrowEmptyResponseException;
//use Webino\Markdown\Feature\Markdown;
//use WebinoConfigLib\Feature\ConfigCacheEnabled;

use WebinoAppLib\Application\CoreConfig;
use WebinoConfigLib\Feature\FirePhpLog;
use WebinoConfigLib\Feature\Log;

return new CoreConfig([
    new Log('data/log/app.log'),
    new FirePhpLog,
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
