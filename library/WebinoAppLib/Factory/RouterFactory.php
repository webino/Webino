<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Factory;

use WebinoAppLib\Exception;
use WebinoBaseLib\Service\SimpleServiceContainer;
use Zend\Console\Console;
use Zend\Log\Exception\InvalidArgumentException;
use Zend\Mvc\Service;

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
        $services->set('config', $this->getConfig()->toArray());
        $services->set('RoutePluginManager', (new Service\RoutePluginManagerFactory)->createService($services));

        try {

            $router = Console::isConsole()
                    ? (new Service\ConsoleRouterFactory)->__invoke($services, 'router')
                    : (new Service\HttpRouterFactory)->__invoke($services, 'router');

        } catch (InvalidArgumentException $exc) {
            throw new Exception\InvalidArgumentException('Unable to create a router', null, $exc);
        }

        return $router;
    }
}
