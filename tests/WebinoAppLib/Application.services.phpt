<?php

use Tester\Assert;
use WebinoAppLib\Application\CoreConfig;
use WebinoAppLib\Exception\UnknownServiceException;
use WebinoAppLib\Factory;
use WebinoAppLib\Feature\Service;
use WebinoAppLib\Feature\CoreService;

require __DIR__ . '/../bootstrap.php';


class MyInvokableService
{

}

class MyService
{
    public function __construct($someDependency)
    {

    }
}

class MyServiceFactory extends Factory\AbstractFactory
{
    protected function create()
    {
        return new MyService(null);
    }
}

class MyCoreInvokableService
{

}

class MyCoreService
{
    public function __construct($someDependency)
    {

    }
}

class MyCoreServiceFactory extends Factory\AbstractFactory
{
    protected function create()
    {
        return new MyCoreService(null);
    }
}

class MyRuntimeInvokableService
{

}

class MyRuntimeService
{
    public function __construct($someDependency)
    {

    }
}

class MyRuntimeServiceFactory extends Factory\AbstractFactory
{
    protected function create()
    {
        return new MyRuntimeService(null);
    }
}


$config = new CoreConfig([

    new Service(MyInvokableService::class),

    new CoreService(MyCoreInvokableService::class),

    new Service(MyService::class, MyServiceFactory::class),

    new CoreService(MyCoreService::class, MyCoreServiceFactory::class),

]);


$appCore = (new Factory)->create($config);


$app = $appCore;


$app->set(MyRuntimeInvokableService::class);

$app->set(MyRuntimeService::class, MyRuntimeServiceFactory::class);


Assert::exception(function () use ($app) {
    $app->get(MyInvokableService::class);
}, UnknownServiceException::class);

Assert::exception(function () use ($app) {
    $app->get(MyService::class);
}, UnknownServiceException::class);

Assert::type(MyCoreInvokableService::class, $app->get(MyCoreInvokableService::class));

Assert::type(MyRuntimeInvokableService::class, $app->get(MyRuntimeInvokableService::class));

Assert::type(MyCoreService::class, $app->get(MyCoreService::class));

Assert::type(MyRuntimeService::class, $app->get(MyRuntimeService::class));


$app = $appCore->bootstrap();


Assert::type(MyInvokableService::class, $app->get(MyInvokableService::class));

Assert::type(MyService::class, $app->get(MyService::class));
