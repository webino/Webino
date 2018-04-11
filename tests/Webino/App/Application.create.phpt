<?php

use Tester\Assert;
use Webino\App\Application;
use Webino\App\Application\ConfiguredApplication;

require __DIR__ . '/../../bootstrap.php';


$settings = ['testSettings' => 'testSettingsValue'];
$config = Webino::config($settings);
$core = Webino::application($config);

$app = $core->bootstrap();

$app->dispatch();


Assert::type(Application::class, $appCore);

Assert::type(ConfiguredApplication::class, $app);

Assert::same(current($settings), $app->getConfig(key($testCustomSetting)));
