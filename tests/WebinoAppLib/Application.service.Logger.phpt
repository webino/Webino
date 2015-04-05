<?php

use Tester\Assert;
use WebinoAppLib\Application;
use WebinoAppLib\Factory;
use WebinoAppLib\Service\Logger;

require __DIR__ . '/../bootstrap.php';


$app = (new Factory)->create()->bootstrap();
$log = $app->getLogger();


Assert::type(Logger::class, $log);
