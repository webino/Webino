<?php

namespace WebinoAppLib\Contract;

use Zend\Config\Config;

/**
 * Interface ConfigInterface
 */
interface ConfigInterface
{
    /**
     * Return core config object or its value
     *
     * @param string|null $name
     * @param mixed|null $default
     * @return Config|mixed
     */
    public function getCoreConfig($name = null, $default = null);
}
