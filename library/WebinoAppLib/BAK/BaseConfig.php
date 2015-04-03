<?php

namespace WebinoAppLib;

use WebinoAppLib\Factory\BootstrapFactory;
use WebinoAppLib\Factory\EventsFactory;
use WebinoAppLib\Feature;
use WebinoConfigLib\DefaultConfigInterface;
use WebinoEventLib\EventManager;
use Zend\Mvc\Service\RequestFactory;
use Zend\Mvc\Service\ResponseFactory;
use Zend\Stdlib\ArrayUtils;

/**
 * Class Config
 */
class BaseConfig extends Feature\Config implements
    DefaultConfigInterface
{
    /**
     * @return array
     */
    public function getDefaultConfig()
    {
        return [
            $this::CORE => [
                $this::SERVICES => [
                    $this::SERVICES_INVOKABLES => [
                        EventsFactory::ENGINE => EventManager::class,
                    ],
                    $this::SERVICES_FACTORIES => [
                        Application::EVENTS => EventsFactory::class,
                        Application::REQUEST => RequestFactory::class,
                        Application::RESPONSE => ResponseFactory::class,
                        Application::BOOTSTRAP => BootstrapFactory::class,
                    ],
                ],
            ],
        ];
    }
}
