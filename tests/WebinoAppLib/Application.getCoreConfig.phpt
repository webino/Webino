<?php

use Tester\Assert;
use WebinoAppLib\Application\CoreConfig;
use WebinoAppLib\Factory;

require __DIR__ . '/../bootstrap.php';


$myConfigExpected = ['myConfigValue'];

$defaultExpected = ['myDefaultConfigValue'];

$config = new CoreConfig([
    [
        CoreConfig::CORE => [
            'myConfigKey' => $myConfigExpected
        ],
    ],
]);


$appCore = (new Factory)->create($config);

$app = $appCore->bootstrap();


$coreConfig = $app->getCoreConfig();

$myConfig = $app->getCoreConfig('myConfigKey');

$myDefault = $app->getConfig('undefinedConfigKey', $defaultExpected);


Assert::same($config->toArray()[CoreConfig::CORE], $coreConfig->toArray());

Assert::same($myConfigExpected, $myConfig->toArray());

Assert::same($defaultExpected, $myDefault);
