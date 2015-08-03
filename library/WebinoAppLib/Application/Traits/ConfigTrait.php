<?php

namespace WebinoAppLib\Application\Traits;

use WebinoAppLib\Application;
use WebinoAppLib\Application\AbstractApplicationInterface;
use WebinoAppLib\Exception\DomainException;
use Zend\Config\Config;

/**
 * Trait Config
 */
trait ConfigTrait
{
    /**
     * @var Config
     */
    private $config;

    /**
     * Return registered service
     *
     * @param string $service Service name
     * @return mixed
     */
    abstract public function get($service);

    /**
     * @param string $name
     * @param mixed $service
     */
    abstract protected function setServicesService($name, $service);

    /**
     * @param string|null $name
     * @param mixed|null $default
     * @return Config|mixed
     */
    public function getConfig($name = null, $default = null)
    {
        return $name ? $this->config->get($name, $default) : $this->config;
    }

    /**
     * @param object|Config $config
     * @param bool $setService
     * @throws DomainException Disallowed config modifications
     */
    public function setConfig(Config $config, $setService = true)
    {
        if ($this->config && $this->config->isReadOnly()) {
            throw new DomainException(
                'Unable to set new application configuration; restricted to read only'
            );
        }

        $this->config = $config;
        $setService and $this->setServicesService(AbstractApplicationInterface::CONFIG, $config);
    }

    /**
     * {@inheritdoc}
     */
    public function getCoreConfig($name = null, $default = null)
    {
        $config = $this->get(Application::CORE_CONFIG);
        return $name ? $config->get($name, $default) : $config;
    }
}
