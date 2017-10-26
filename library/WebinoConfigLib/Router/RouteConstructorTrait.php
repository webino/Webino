<?php

namespace WebinoConfigLib\Router;

/**
 * Trait RouteConstructorTrait
 */
trait RouteConstructorTrait
{
    /**
     * {@inheritdoc}
     * @see \WebinoConfigLib\Router\RouteConstructorInterface
     */
    public function __construct($route = null)
    {
        $route and $this->setRoute($route);

        $this
            ->setType()
            ->init();
    }

    /**
     * @param string $route
     * @return $this
     */
    abstract protected function setRoute($route);

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
