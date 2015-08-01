<?php

use Tester\Assert;
use WebinoAppLib\Application\CoreConfig;
use WebinoAppLib\Factory;
use WebinoAppLib\Feature\MemoryCache;

require __DIR__ . '/../bootstrap.php';


$cachedValueExpected = ['myCachedValue'];

$config = new CoreConfig([
    new MemoryCache,
]);


$app = (new Factory)->create($config)->bootstrap();


$cached = $app->getCache('myCacheKey');

$app->setCache('myCacheKey', $cachedValueExpected);

$cached2 = $app->getCache('myCacheKey');


Assert::null($cached);

Assert::same($cachedValueExpected, $cached2);
