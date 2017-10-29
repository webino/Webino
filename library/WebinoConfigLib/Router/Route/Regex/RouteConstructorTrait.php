<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoConfigLib\Router\Route\Regex;

use WebinoConfigLib\Router\RouteInterface;

/**
 * Trait RouteConstructorTrait
 */
trait RouteConstructorTrait
{
    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $spec;

    /**
     * {@inheritdoc}
     * @see \WebinoConfigLib\Router\Route\Regex\RouteConstructorInterface
     */
    public function __construct($path, $spec = null)
    {
        $this
            ->setPath($path)
            ->setSpec($spec)
            ->setType(RouteInterface::REGEX)
            ->init();
    }

    /**
     * @param string $type Route type.
     * @return $this
     */
    abstract public function setType($type = RouteInterface::LITERAL);

    /**
     * Initialize route
     *
     * @return void
     */
    abstract protected function init();

    /**
     * @return bool
     */
    protected function hasRoute()
    {
        return !empty($this->route);
    }

    /**
     * @return string
     */
    protected function getPath()
    {
        return $this->path;
    }

    /**
     * @param string|null $path
     * @return $this
     */
    public function setPath($path = null)
    {
        $this->path = (string) $path;
        return $this;
    }
    
    /**
     * @return bool
     */
    protected function hasSpec()
    {
        return !empty($this->spec);
    }

    /**
     * @return string
     */
    protected function getSpec()
    {
        return $this->spec;
    }

    /**
     * @param string|null $spec
     * @return $this
     */
    protected function setSpec($spec = null)
    {
        $this->spec = (string) $spec;
        return $this;
    }
}
