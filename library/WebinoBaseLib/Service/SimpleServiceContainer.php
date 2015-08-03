<?php

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
