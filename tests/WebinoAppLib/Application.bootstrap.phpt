<?php

use BsbFlysystem\Service\FilesystemManager;
use Tester\Assert;
use WebinoAppLib\Application;
use WebinoAppLib\Application\ConfiguredApplication;
use WebinoAppLib\Service\DebuggerInterface;
use WebinoEventLib\EventManager;
use WebinoLogLib\LoggerInterface;
use Zend\Cache\Storage\StorageInterface;
use Zend\Config\Config;
use Zend\ServiceManager\ServiceManager;

require __DIR__ . '/../bootstrap.php';


$appCore = Webino::application();

$app = $appCore->bootstrap();

Assert::type(Application::class, $appCore);
Assert::type(ConfiguredApplication::class, $app);
Assert::type(ServiceManager::class, $app->getServices());
Assert::type(Config::class, $app->getConfig());
Assert::type(EventManager::class, $app->getEvents());
Assert::type(DebuggerInterface::class, $app->getDebugger());
Assert::type(LoggerInterface::class, $app->getLogger());
Assert::type(StorageInterface::class, $app->getCache());
Assert::type(FilesystemManager::class, $app->getFiles());
