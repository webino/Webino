<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2018 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace Webino\Services\Factories;

use Webino\Services\ServiceContainerInterface;

/**
 * Interface FactoryInterface
 */
interface FactoryInterface
{
    /**
     * Create new service
     *
     * @param ServiceContainerInterface $services Services container
     * @return mixed
     */
    public function create(ServiceContainerInterface $services);
}
