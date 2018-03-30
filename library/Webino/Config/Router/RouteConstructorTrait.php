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
 * Trait RouteConstructorTrait
 */
trait RouteConstructorTrait
{
    /**
     * {@inheritdoc}
     * @see \WebinoConfigLib\Router\RouteConstructorInterface
     */
    public function __construct($path = null)
    {
        $path and $this->setPath($path);
        $this->setType()->init();
    }

    /**
     * @param string|array $path Route path
     * @return $this
     */
    abstract protected function setPath($path);

    /**
     * @param string $type Route type
     * @return $this
     */
    abstract public function setType($type = RouteInterface::LITERAL);

    /**
     * Initialize route
     *
     * @return void
     */
    abstract protected function init();
}
