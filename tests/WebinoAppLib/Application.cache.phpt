<?php

use Tester\Assert;
use WebinoAppLib\Feature\MemoryCache;

require __DIR__ . '/../bootstrap.php';


$cachedValueExpected = ['myCachedValue'];
$config = Webino::config([new MemoryCache]);
$app = Webino::application($config)->bootstrap();


$cached = $app->getCache('myCacheKey');
$app->setCache('myCacheKey', $cachedValueExpected);
$cached2 = $app->getCache('myCacheKey');


Assert::null($cached);
Assert::same($cachedValueExpected, $cached2);
