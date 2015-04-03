<?php

use Tester\Assert;
use WebinoConfigLib\Config;
use WebinoConfigLib\Feature\Cache;
use WebinoConfigLib\Feature\Route;

require __DIR__ . '/../bootstrap.php';


$config = new Config([

    /**
     * Array config fragment example
     */
    ['example_settings' => ['example_key' => 'example_value']],

    /**
     * Config feature example
     */
    new Cache,

    /**
     * Route config feature example
     */
    new Route('/', 'ExampleHandler'),

    /**
     * Named route example
     */
    new Route(['home', '/home'], ['default' => 'ExampleHandler']),

    /**
     * Override named route example
     */
    (new Route(['home', '/home2'], ['default' => 'ExampleHandler2'])),

    /**
     * Override named route example 2
     */
    (new Route(['home']))
        ->setType('segment')
        ->setDefaults(['testParam' => 'testParamValue']),

    /**
     * Route childs example
     */
    (new Route(['home']))
        ->setChild(new Route(['about']))

]);


Assert::equal(require 'files/config.create.expectedConfig.php', $config->toArray());
