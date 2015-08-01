<?php

namespace WebinoAppLib\Application;

use WebinoAppLib\Application;
use WebinoAppLib\Factory\ApplicationFactory;
use WebinoAppLib\Factory\BootstrapFactory;
use WebinoAppLib\Factory\EventsFactory;
use WebinoAppLib\Factory\LoggerFactory;
use WebinoAppLib\Feature;
use WebinoConfigLib\DefaultConfigInterface;
use WebinoEventLib\EventManager;
use Zend\Mvc\Service\RequestFactory;
use Zend\Mvc\Service\ResponseFactory;

/**
 * Class CoreConfig
 */
class CoreConfig extends Feature\Config implements
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
                        Application::SERVICE   => ApplicationFactory::class,
                        Application::EVENTS    => EventsFactory::class,
                        Application::BOOTSTRAP => BootstrapFactory::class,
                        Application::LOGGER    => LoggerFactory::class,
                    ],
                ],
            ],
        ];
    }
}
