<?php

use Tester\Assert;
use WebinoAppLib\Application;
use WebinoAppLib\Application\ConfiguredApplication;
use WebinoAppLib\Factory;
use WebinoAppLib\Service\DebuggerInterface;
use WebinoEventLib\EventManager;
use Zend\Cache\Storage\StorageInterface;
use Zend\Config\Config;
use Zend\Log\LoggerInterface;
use Zend\Stdlib\RequestInterface;
use Zend\Stdlib\ResponseInterface;

require __DIR__ . '/../bootstrap.php';


$app = (new Factory)->create();

$configured = $app->bootstrap();


Assert::type(Application::class, $app);
Assert::type(ConfiguredApplication::class, $configured);
Assert::type(Config::class, $app->getConfig());
Assert::type(EventManager::class, $app->getEvents());
Assert::type(RequestInterface::class, $app->getRequest());
Assert::type(ResponseInterface::class, $app->getResponse());
Assert::type(DebuggerInterface::class, $app->getDebugger());
Assert::type(LoggerInterface::class, $app->getLogger());
Assert::type(StorageInterface::class, $app->getCache());
