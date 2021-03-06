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

use WebinoConfigLib\AbstractConfig;
use WebinoConfigLib\Exception\InvalidArgumentException;

/**
 * Class AbstractRoute
 */
abstract class AbstractRoute extends AbstractConfig implements RouteInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $path;

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
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->name = (string) $name;
        return $this;
    }

    /**
     * @return bool
     */
    protected function hasPath()
    {
        return !is_null($this->path);
    }

    /**
     * @return string
     */
    protected function getPath()
    {
        return $this->path;
    }

    /**
     * {@inheritdoc}
     */
    public function setPath($path)
    {
        $this->path = (string) $path;
        return $this;
    }

    /**
     * @param string $route
     * @return $this
     */
    protected function setRouteOption($route)
    {
        $this->getData()->options['route'] = (string) $route;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->getData()->type;
    }

    /**
     * {@inheritdoc}
     */
    public function setType($type = self::LITERAL)
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
    public function setChild(array $routes)
    {
        foreach ($routes as $route) {
            $this->appendChildRoute($route);
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
     * @return $this
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
     * @return $this
     */
    protected function appendRoute($section, self $route)
    {
        if ($route->hasName()) {
            $this->mergeArray([$section => [$route->getName() => $route->toArray()]]);
            return $this;
        }

        if ($this->getData()->offsetExists($section)) {
            $this->getData()->{$section}[] = $route->toArray();
            return $this;
        }

        $this->mergeArray([$section => [$route->toArray()]]);
        return $this;
    }

    /**
     * @param RouteInterface $route
     * @return $this
     */
    protected function appendChildRoute(RouteInterface $route)
    {
        if (!($route instanceof self)) {
            throw (new InvalidArgumentException('Expected route of type %s but got %s'))
                ->format(self::class, get_class($route));
        }
        $this->appendRoute('child_routes', $route);
        return $this;
    }
}
