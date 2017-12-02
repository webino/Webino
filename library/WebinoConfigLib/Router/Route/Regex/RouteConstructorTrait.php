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
     * @param string $path
     * @return $this
     */
    abstract protected function setPath($path);

    /**
     * @param string|null $spec
     * @return $this
     */
    abstract protected function setSpec($spec = null);

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
}
