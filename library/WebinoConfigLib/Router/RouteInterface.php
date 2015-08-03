<?php

namespace WebinoConfigLib\Router;

use Zend\Stdlib\ArrayUtils;

/**
 * Class AbstractRoute
 */
interface RouteInterface
{
    /**
     * Literal route type
     */
    const LITERAL = 'literal';

    /**
     * Simple route type
     */
    const SIMPLE = 'simple';

    /**
     * Segment route type
     */
    const SEGMENT = 'segment';

    /**
     * Regular expression route type
     */
    const REGEX = 'regex';

    /**
     * @param string $type Route type.
     * @return self
     */
    public function setType($type = self::LITERAL);

    /**
     * @param string $name Route name.
     * @return self
     */
    public function setName($name);

    /**
     * @param string $route Route path.
     * @return self
     */
    public function setRoute($route);

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
     * @param self[] $routes
     * @return self
     */
    public function setChild(array $routes);

    /**
     * @param self[] $routes
     * @return self
     */
    public function chain(array $routes);
}
