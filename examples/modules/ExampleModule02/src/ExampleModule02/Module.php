<?php

namespace ExampleModule02;

use Application;
use Webino\Module\AbstractModule;
// TODO events
use Zend\EventManager\Event as ConfigEvent;

/**
 * Class Module
 */
class Module extends AbstractModule
{
    public function getConfig(ConfigEvent $event)
    {
        return [
            'example_module_02' => [
                'test_key' => ['example_value'],
            ],
        ];
    }
}
