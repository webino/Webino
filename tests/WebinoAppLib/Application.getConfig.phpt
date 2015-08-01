<?php

use Tester\Assert;
use WebinoAppLib\Application\CoreConfig;
use WebinoAppLib\Factory;

require __DIR__ . '/../bootstrap.php';


$runtimeExpected = ['myRuntimeConfigValue'];

$myConfigExpected = ['myConfigValue'];

$defaultExpected = ['myDefaultConfigValue'];

$config = new CoreConfig([
    ['myConfigKey' => $myConfigExpected],
]);


$appCore = (new Factory)->create($config);


$appCore->getConfig()->myRuntimeConfigKey = $runtimeExpected;


$app = $appCore->bootstrap();


$runtimeConfig = $app->getConfig('myRuntimeConfigKey');

$myConfig = $app->getConfig('myConfigKey');

$myDefault = $app->getConfig('undefinedConfigKey', $defaultExpected);


Assert::same($runtimeExpected, $runtimeConfig->toArray());

Assert::same($myConfigExpected, $myConfig->toArray());

Assert::same($defaultExpected, $myDefault);
