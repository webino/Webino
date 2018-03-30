<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2018 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace Webino\Config\Router;

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
        // TODO ???
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
