<?php

namespace WebinoConfigLib\Router\Route\Regex;

use WebinoConfigLib\Router\RouteConstructorTrait as BaseRouteConstructorTrait;

/**
 * Trait RouteConstructorTrait
 */
trait RouteConstructorTrait
{
    use BaseRouteConstructorTrait {
        __construct as __internalConstruct;
    }

    /**
     * @var string
     */
    private $spec;

    /**
     * {@inheritdoc}
     * @see \WebinoConfigLib\Router\Route\Regex\RouteConstructorInterface
     */
    public function __construct($route, $spec = null, $handlers = null)
    {
        $this->setSpec($spec);
        $this->__internalConstruct($route, $handlers);
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
