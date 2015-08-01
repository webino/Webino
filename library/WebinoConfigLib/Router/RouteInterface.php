<?php

namespace WebinoConfigLib\Router;

use Zend\Stdlib\ArrayUtils;

/**
 * Class AbstractRoute
 */
interface RouteInterface
{
     /**
     * @param string $type
     * @return self
     */
    public function setType($type);

    /**
     * @param bool $mayTerminate
     * @return self
     */
    public function setMayTerminate($mayTerminate = true);

    /**
     * @param array $defaults
     * @return self
     */
    public function setDefaults(array $defaults);

    /**
     * @param self $route
     * @return self
     */
    public function setChild(self $route);

    /**
     * @param self[] $routes
     * @return self
     */
    public function setChildren(array $routes);

    /**
     * @param self[] $routes
     * @return self
     */
    public function chain(array $routes);
}
