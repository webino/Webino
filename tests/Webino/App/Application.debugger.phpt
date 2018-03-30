<?php

use Tester\Assert;
use WebinoAppLib\Application;
use WebinoAppLib\Application\ConfiguredApplication;
use WebinoAppLib\Service\Debugger;

require __DIR__ . '/../bootstrap.php';


$options = [];


$debugger = Webino::debugger($options);


Assert::type(Debugger::class, $debugger);
