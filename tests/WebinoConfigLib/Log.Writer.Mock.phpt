<?php

use Tester\Assert;
use WebinoConfigLib\Feature\Route;
use WebinoConfigLib\Log\Writer\Mock;

require __DIR__ . '/../bootstrap.php';


$config = new Mock;


$expected = ['name' => 'mock'];

Assert::equal($expected, $config->toArray());
