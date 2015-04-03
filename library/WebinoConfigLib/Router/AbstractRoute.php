<?php

namespace WebinoConfigLib\Router;

use WebinoConfigLib\AbstractConfig;
use WebinoConfigLib\Exception\InvalidArgumentException;
use Zend\Stdlib\ArrayUtils;

/**
 * Class AbstractRoute
 */
abstract class AbstractRoute extends AbstractConfig implements
    RouteInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $route;

    /**
     * @return bool
     */
    public function hasName()
    {
        return !empty($this->name);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return self
     */
    protected function setName($name)
    {
        $this->name = (string) $name;
        return $this;
    }

    /**
     * @return bool
     */
    protected function hasRoute()
    {
        return !is_null($this->route);
    }

    /**
     * @return string
     */
    protected function getRoute()
    {
        return $this->route;
    }

    /**
     * @param string $route
     * @return self
     */
    protected function setRoute($route)
    {
        $this->route = (string) $route;
        return $this;
    }

    /**
     * @param string $route
     * @return self
     */
    protected function setRouteOption($route)
    {
        $this->getData()->options['route'] = (string) $route;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setType($type)
    {
        $this->getData()->type = (string) $type;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setMayTerminate($mayTerminate = true)
    {
        $this->getData()->may_terminate = $mayTerminate;
        return $this;
    }

    /**
     * @return array
     */
    protected function getDefaults()
    {
        return $this->getData()->options['defaults'];
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaults(array $defaults)
    {
        $data = $this->getData();
        foreach ($defaults as $key => $value) {
            $data->options['defaults'][$key] = $value;
        }
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setChild(RouteInterface $route)
    {
        if (!($route instanceof self)) {
            throw (new InvalidArgumentException('Expected route of type %s but got %s'))
                ->format(self::class, get_class($route));
        }
        $this->appendRoute('child_routes', $route);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setChilds(array $routes)
    {
        foreach ($routes as $route) {
            $this->setChild($route);
        }
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function chain(array $routes)
    {
        foreach ($routes as $route) {
            $this->appendRoute('chain_routes', $route);
        }
        return $this;
    }

    /**
     * @param array $handlers
     * @return self
     */
    protected function setHandlers(array $handlers)
    {
        $data = $this->getData();
        foreach ($handlers as $key => $value) {
            $data->options['defaults']['handlers'][$key] = $value;
        }
        return $this;
    }

    /**
     * @param string $section
     * @param self $route
     * @return self
     */
    protected function appendRoute($section, self $route)
    {
        $route->hasName()
            and $this->getData()->{$section}[$route->getName()] = $route->toArray()
            or  $this->getData()->{$section}[] = $route->toArray();

        return $this;
    }
}
