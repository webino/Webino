<?php

namespace WebinoAppLib\Service\Initializer;

use WebinoAppLib\Application;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\InitializerInterface;

/**
 * Class RoutingAwareInitializer
 */
class RoutingAwareInitializer implements InitializerInterface
{
    /**
     * @param $instance
     * @param ServiceLocatorInterface $services
     */
    public function initialize($instance, ServiceLocatorInterface $services)
    {
        if ($instance instanceof RoutingAwareInterface) {
            /** @var \WebinoAppLib\Contract\RouterInterface $router */
            $router = $services->get(Application::SERVICE);
            $instance->setRouter($router);
        }
    }
}
