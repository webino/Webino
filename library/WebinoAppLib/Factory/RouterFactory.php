<?php

namespace WebinoAppLib\Factory;

use WebinoAppLib\Application;
use WebinoAppLib\Exception;
use WebinoBaseLib\Service\SimpleServiceContainer;
use Zend\Log\Exception\InvalidArgumentException;
use Zend\Mvc\Service\RoutePluginManagerFactory;
use Zend\Mvc\Service\RouterFactory as BaseRouterFactory;

/**
 * Class RouterFactory
 */
class RouterFactory extends AbstractFactory
{
    /**
     * Create a router
     *
     * @return \Zend\Mvc\Router\RouteStackInterface
     * @throws Exception\InvalidArgumentException Unable to create a router
     */
    protected function create()
    {
        $services = new SimpleServiceContainer;
        $services->set('Config', $this->getConfig()->toArray());
        $services->set('RoutePluginManager', (new RoutePluginManagerFactory)->createService($services));

        try {
            $router = (new BaseRouterFactory)->createService($services, 'router');
        } catch (InvalidArgumentException $exc) {
            throw new Exception\InvalidArgumentException('Unable to create a router', null, $exc);
        }

        return $router;
    }
}
