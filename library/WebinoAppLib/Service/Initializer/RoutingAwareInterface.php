<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Service\Initializer;

use WebinoAppLib\Contract\RouterInterface;

/**
 * Interface RoutingAwareInterface
 */
interface RoutingAwareInterface
{
    /**
     * @return RouterInterface|null
     */
    public function getRouter();

    /**
     * @param RouterInterface $router
     */
    public function setRouter(RouterInterface $router);
}
