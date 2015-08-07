<?php

use Tester\Assert;

require __DIR__ . '/../bootstrap.php';


$runtimeExpected = ['myRuntimeConfigValue'];

$myConfigExpected = ['myConfigValue'];

$defaultExpected = ['myDefaultConfigValue'];

$config = Webino::config([
    ['myConfigKey' => $myConfigExpected],
]);


$appCore = Webino::application($config);


$appCore->getConfig()->myRuntimeConfigKey = $runtimeExpected;


$app = $appCore->bootstrap();


$runtimeConfig = $app->getConfig('myRuntimeConfigKey');

$myConfig = $app->getConfig('myConfigKey');

$myDefault = $app->getConfig('undefinedConfigKey', $defaultExpected);


Assert::same($runtimeExpected, $runtimeConfig->toArray());

Assert::same($myConfigExpected, $myConfig->toArray());

Assert::same($defaultExpected, $myDefault);
