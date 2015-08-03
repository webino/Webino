<?php

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
    private $route;

    /**
     * @var string
     */
    private $spec;

    /**
     * {@inheritdoc}
     * @see \WebinoConfigLib\Router\Route\Regex\RouteConstructorInterface
     */
    public function __construct($route, $spec = null)
    {
        $this
            ->setRoute($route)
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
    protected function getRoute()
    {
        return $this->route;
    }

    /**
     * @param string|null $route
     * @return $this
     */
    public function setRoute($route = null)
    {
        $this->route = (string) $route;
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
