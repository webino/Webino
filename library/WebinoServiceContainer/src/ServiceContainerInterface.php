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
 * Interface ServiceContainerInterface
 */
interface ServiceContainerInterface extends ContainerInterface
{
    /**
     * Set entry
     *
     * @param string $id Entry identifier
     * @param mixed $entry Container entry
     * @return void
     */
    public function set(string $id, $entry) : void;
}
