<?php

use Tester\Assert;
use WebinoAppLib\Factory;

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


$app = (new Factory)->create()->bootstrap();

$app->set(MyInvokableService::class);

$app->set(MyService::class, MyServiceFactory::class);


Assert::type(MyInvokableService::class, $app->get(MyInvokableService::class));

Assert::type(MyService::class, $app->get(MyService::class));
