<?php

namespace WebinoAppLib\Application;

use WebinoAppLib\Application;
use WebinoAppLib\Factory\ApplicationFactory;
use WebinoAppLib\Factory\BootstrapFactory;
use WebinoAppLib\Factory\EventsFactory;
use WebinoAppLib\Feature;
use WebinoConfigLib\DefaultConfigInterface;
use WebinoConfigLib\Log\Writer\Noop;
use WebinoEventLib\EventManager;
use Zend\Log\LoggerServiceFactory;
use Zend\Mvc\Service\RequestFactory;
use Zend\Mvc\Service\ResponseFactory;
use Zend\Stdlib\ArrayUtils;

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
        $this->addFeature(new \WebinoConfigLib\Feature\NoopLog);

        return [
            $this::CORE => [
                $this::SERVICES => [
                    $this::SERVICES_INVOKABLES => [
                        EventsFactory::ENGINE => EventManager::class,
                    ],
                    $this::SERVICES_FACTORIES => [
                        Application::SERVICE => ApplicationFactory::class,
                        Application::EVENTS => EventsFactory::class,
                        Application::REQUEST => RequestFactory::class,
                        Application::RESPONSE => ResponseFactory::class,
                        Application::BOOTSTRAP => BootstrapFactory::class,
                        Application::LOGGER => LoggerServiceFactory::class,
                    ],
                ],
            ],
        ];
    }
}
