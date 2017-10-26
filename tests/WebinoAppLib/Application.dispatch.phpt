<?php

use Tester\Assert;

require __DIR__ . '/../bootstrap.php';


$appCore = Webino::application();

$app = $appCore->bootstrap();

$app->dispatch();


// TODO
Assert::true(true);
