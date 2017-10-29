<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoBaseLib\Service;

use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class SimpleServiceContainer
 */
class SimpleServiceContainer implements ServiceLocatorInterface
{
    /**
     * @var array
     */
    private $services = [];

    /**
     * {@inheritdoc}
     */
    public function get($name)
    {
        return $this->services[$name];
    }

    /**
     * {@inheritdoc}
     */
    public function has($name)
    {
        return isset($this->services);
    }

    /**
     * @param string $name
     * @param mixed $service
     */
    public function set($name, $service)
    {
        $this->services[$name] = $service;
    }
}
