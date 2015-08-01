<?php

namespace WebinoAppLib\Application\Traits;

use WebinoAppLib\Application;

/**
 * Trait Config
 */
trait ConfigTrait
{
    /**
     * Return registered service
     *
     * @param string $service Service name
     * @return mixed
     */
    abstract public function get($service);

    /**
     * {@inheritdoc}
     */
    public function getCoreConfig($name = null, $default = null)
    {
        $config = $this->get(Application::CORE_CONFIG);
        return $name ? $config->get($name, $default) : $config;
    }
}
