<?php

use Tester\Assert;
use WebinoAppLib\Application\CoreConfig;

require __DIR__ . '/../bootstrap.php';


$myConfigExpected = ['myConfigValue'];

$defaultExpected = ['myDefaultConfigValue'];

$config = Webino::config([
    [
        CoreConfig::CORE => [
            'myConfigKey' => $myConfigExpected
        ],
    ],
]);


$appCore = Webino::application($config);

$app = $appCore->bootstrap();


$coreConfig = $app->getCoreConfig();

$myConfig = $app->getCoreConfig('myConfigKey');

$myDefault = $app->getConfig('undefinedConfigKey', $defaultExpected);


Assert::same($config->toArray()[CoreConfig::CORE], $coreConfig->toArray());

Assert::same($myConfigExpected, $myConfig->toArray());

Assert::same($defaultExpected, $myDefault);
