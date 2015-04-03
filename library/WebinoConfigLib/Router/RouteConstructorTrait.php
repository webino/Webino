<?php

namespace WebinoConfigLib\Router;

use WebinoConfigLib\Exception\InvalidArgumentException;

/**
 * Trait RouteConstructorTrait
 */
trait RouteConstructorTrait
{
    /**
     * {@inheritdoc}
     * @see \WebinoConfigLib\Router\RouteConstructorInterface
     */
    public function __construct($route, $handlers = null)
    {
        $isArray = is_array($route);
        if ($isArray && 2 < count($route)) {
            throw (new InvalidArgumentException('Expected route param in format %s but got %s'))
                ->format('[name] or [name, route]', $route);
        }

        $specs = $isArray ? $route : [null, $route];
        $this->setName($specs[0]);
        empty($specs[1]) or $this->setRoute($specs[1]);

        $this->getData()->exchangeArray([
            'type' => 'literal',
            'options' => ['defaults' => []],
        ]);

        if (!empty($handlers)) {
            $manyHandlers = is_array($handlers) && !is_object(current($handlers));
            $this->setHandlers($manyHandlers ? $handlers : [$handlers]);
        }

        $this->init();
    }

    /**
     * @return \ArrayObject
     */
    abstract protected function getData();

    /**
     * @param string $name
     * @return self
     */
    abstract protected function setName($name);

    /**
     * @param string $route
     * @return self
     */
    abstract protected function setRoute($route);

    /**
     * @param array $handlers
     */
    abstract protected function setHandlers(array $handlers);

    /**
     * Initialize route
     *
     * @return void
     */
    abstract protected function init();
}
