<?php

use Tester\Assert;
use WebinoAppLib\Application\CoreConfig;
use WebinoAppLib\Factory;
use WebinoAppLib\Feature\InvokableService;
use WebinoAppLib\Feature\ServiceFactory;

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

    new InvokableService(MyInvokableService::class),

    new ServiceFactory(MyService::class, MyServiceFactory::class),

]);


$app = (new Factory)->create($config)->bootstrap();


$app->set(MyRuntimeInvokableService::class);

$app->set(MyRuntimeService::class, MyRuntimeServiceFactory::class);


Assert::type(MyInvokableService::class, $app->get(MyInvokableService::class));

Assert::type(MyRuntimeInvokableService::class, $app->get(MyRuntimeInvokableService::class));

Assert::type(MyService::class, $app->get(MyService::class));

Assert::type(MyRuntimeService::class, $app->get(MyRuntimeService::class));
