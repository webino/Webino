<?php

use Tester\Assert;
use Webino\App\Application;
use Webino\App\Application\ConfiguredApplication;

require __DIR__ . '/../bootstrap.php';


$testCustomSetting = ['testCustomSetting' => 'testCustomSettingValue'];

$config = Webino::config([
    $testCustomSetting,
]);

$appCore = Webino::application($config);

$app = $appCore->bootstrap();

$app->dispatch();


Assert::type(Application::class, $appCore);

Assert::type(ConfiguredApplication::class, $app);

Assert::same(current($testCustomSetting), $app->getConfig(key($testCustomSetting)));
