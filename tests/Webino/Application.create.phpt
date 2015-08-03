<?php

use Tester\Assert;
use WebinoAppLib\Application;
use WebinoAppLib\Application\ConfiguredApplication;

require __DIR__ . '/../bootstrap.php';


$testCustomSetting = ['testCustomSetting' => 'testCustomSettingValue'];

$config = new Application\CoreConfig([
    $testCustomSetting,
]);


$appCore = Webino::application($config);

$app = $appCore->bootstrap();

$app->dispatch();


Assert::type(Application::class, $appCore);

Assert::type(ConfiguredApplication::class, $app);

Assert::same(current($testCustomSetting), $app->getConfig(key($testCustomSetting)));
