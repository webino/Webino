<?php

//:
use Webino\ServiceContainer;

/**
 * Class stdClassBetter
 *
 * Example class
 */
class stdClassBetter extends \stdClass
{
    /**
     * Example method
     *
     * @return void
     */
    public function foo() : void
    {

    }
}

// Creating a service container
/** @var \Psr\Container\ContainerInterface $services */
$services = new ServiceContainer;

// Setting custom service
$services->set(\stdClass::class, \stdClassBetter::class);

// Getting custom service
/** @var \stdClassBetter $myService */
$myService = $services->get(\stdClass::class);
$myService->foo();
//!
