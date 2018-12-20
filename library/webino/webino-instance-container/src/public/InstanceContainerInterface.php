<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2018 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace Webino;

use Psr\Container\ContainerInterface;

/**
 * Interface InstanceContainerInterface
 * @package webino-instance-container
 */
interface InstanceContainerInterface extends ContainerInterface
{
    /**
     * Set entry
     *
     * @param string $id Entry identifier
     * @param mixed $entry Container entry
     * @return void
     */
    function set(string $id, $entry): void;

    /**
     * Create new entry
     *
     * @param string $class Instance class
     * @param array $parameter Optional parameters
     * @throws InstanceNotFoundException No entry was found for identifier
     * @throws InstanceContainerException Error while retrieving the entry
     * @return mixed
     */
    function create(string $class, ...$parameter);
}
