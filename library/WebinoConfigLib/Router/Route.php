<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoConfigLib\Router;

/**
 * Class Route
 */
class Route extends AbstractRoute implements RouteConstructorInterface
{
    use RouteConstructorTrait;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
//        $this->hasPath() and $this->setRouteOption($this->getPath());
    }

    /**
     * {@inheritdoc}
     */
    public function setPath($path)
    {
        parent::setPath($path);
        $path and $this->setRouteOption($path);
        return $this;
    }
}
