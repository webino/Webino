<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2018 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

use Tester\Assert;
use Webino\Config\Config;
use Webino\Config\Feature\FilesystemCache;
use Webino\Config\Feature\Route;

require __DIR__ . '/../bootstrap.php';


$config = new Config([

    /**
     * Array config fragment example
     */
    ['example_settings' => ['example_key' => 'example_value']],

    /**
     * Config feature example
     */
    new FilesystemCache,

    /**
     * Route config feature example
     */
    (new Route)->setPath('/'),

    /**
     * Named route example
     */
    (new Route('home'))->setPath('/home'),

    /**
     * Override named route example
     */
    (new Route('home'))->setPath('/home2'),

    /**
     * Override named route example 2
     */
    (new Route('home'))
        ->setType('segment')
        ->setDefaults(['testParam' => 'testParamValue']),

    /**
     * Route childs example
     */
    (new Route('home'))
        ->setChild([new Route('about')])

]);


Assert::equal(require 'files/config.create.expectedConfig.php', $config->toArray());
