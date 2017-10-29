<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

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
