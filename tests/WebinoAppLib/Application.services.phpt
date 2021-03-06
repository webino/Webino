<?php

use Tester\Assert;
use WebinoAppLib\Exception\UnknownServiceException;
use WebinoAppLib\Factory\AbstractFactory;
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

class MyServiceFactory extends AbstractFactory
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

class MyCoreServiceFactory extends AbstractFactory
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

class MyRuntimeServiceFactory extends AbstractFactory
{
    protected function create()
    {
        return new MyRuntimeService(null);
    }
}


$config = Webino::config([

    new Service(MyInvokableService::class),

    // TODO test invokable service alias test

    new CoreService(MyCoreInvokableService::class),

    // TODO test core invokable service alias test

    new Service(MyService::class, MyServiceFactory::class),

    // TODO test service factory alias test

    new CoreService(MyCoreService::class, MyCoreServiceFactory::class),

    // TODO test core service factory alias test

]);


$appCore = Webino::application($config);


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
