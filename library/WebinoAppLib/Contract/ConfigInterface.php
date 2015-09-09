<?php

namespace WebinoAppLib\Contract;

/**
 * Interface ConfigInterface
 */
interface ConfigInterface
{
    /**
     * @param string|null $name
     * @param mixed|null $default
     * @return \WebinoAppLib\Application\Config|mixed
     */
    public function getConfig($name = null, $default = null);

    /**
     * @param array|\WebinoAppLib\Application\Config|object $config
     * @throws \WebinoAppLib\Exception\DomainException Disallowed config modifications
     */
    public function setConfig($config);

    /**
     * Return core config object or its value
     *
     * @param string|null $name
     * @param mixed|null $default
     * @return \WebinoAppLib\Application\Config|mixed
     */
    public function getCoreConfig($name = null, $default = null);

    /**
     * @param callable $callback
     */
    public function onConfig(callable $callback);
}
