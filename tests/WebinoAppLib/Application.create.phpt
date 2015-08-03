<?php

use Tester\Assert;
use WebinoAppLib\Application;
use WebinoAppLib\Application\ConfiguredApplication;
use WebinoAppLib\Factory;
use WebinoAppLib\Service\DebuggerInterface;
use WebinoAppLib\Service\LoggerInterface;
use WebinoEventLib\EventManager;
use Zend\Cache\Storage\StorageInterface;
use Zend\Config\Config;

require __DIR__ . '/../bootstrap.php';


$appCore = (new Factory)->create();

$app = $appCore->bootstrap();

$app->dispatch();


Assert::type(Application::class, $appCore);
Assert::type(ConfiguredApplication::class, $app);
Assert::type(Config::class, $app->getConfig());
Assert::type(EventManager::class, $app->getEvents());
Assert::type(DebuggerInterface::class, $app->getDebugger());
Assert::type(LoggerInterface::class, $app->getLogger());
Assert::type(StorageInterface::class, $app->getCache());
