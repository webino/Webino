<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

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
     * @param RoutingAwareInterface|object $instance
     * @param ServiceLocatorInterface $services
     * @return void
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
