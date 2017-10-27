<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Router;

use WebinoConfigLib\Feature\FeatureInterface;
use WebinoConfigLib\Feature\Route;

/**
 * Class DefaultRoute
 */
class DefaultRoute implements
    FeatureInterface,
    RouteInterface
{
    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return (new Route(self::class))
            ->setLiteral('/')
            ->toArray();
    }
}
