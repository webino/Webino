<?php

namespace ExampleModule;

use Webino\Application;
use Webino\Config\Feature\Route;
use Webino\Module\AbstractModule;
use Webino\Module\Config;
// TODO events
use Zend\EventManager\Event;
use Zend\EventManager\Event as ConfigEvent;
use Zend\EventManager\Event as DispatchEvent;

/**
 * Class Module
 */
class Module extends AbstractModule
{
    // TODO interface
    public function getDependencies()
    {
        return ['ExampleModule02'];
    }

    // TODO interface
    public function getConfig(ConfigEvent $event)
    {
        return new Config([

            'example_module' => [
                'test_key' => ['example_value'],
            ],

            new Route('/listener-test', 'ExampleModule\Listener\ExampleListener'),

            new Route('/config', [$this, 'homeAction']),
        ]);
    }

    // TODO interface
    public function onConsole(Event $event)
    {
        // console initializer
    }

    // TODO interface
    public function onHttp(Event $event)
    {
        // http initializer
    }

    public function homeAction(Event $event)
    {
        return 'TEST HOME X';
    }

    public function exampleAction(Event $event)
    {
        return 'TEST EXAMPLE';
    }
}
