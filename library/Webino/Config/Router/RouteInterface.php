<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2018 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace Webino\Config\Router;

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
     * @param string $type Route type
     * @return $this
     */
    public function setType(string $type = self::LITERAL) : self;

    /**
     * @param string $name Route name.
     * @return $this
     */
    public function setName(string $name) : self;

    /**
     * @param string|array $route Route path
     * @return $this
     */
    public function setPath($route) : self;

    /**
     * @param bool $mayTerminate
     * @return $this
     */
    public function setMayTerminate(bool $mayTerminate = true) : self;

    /**
     * @param array $defaults
     * @return $this
     */
    public function setDefaults(array $defaults) : self;

    /**
     * @param self[] $routes
     * @return $this
     */
    public function setChild(array $routes) : self;

    /**
     * @param self[] $routes
     * @return $this
     */
    public function chain(array $routes) : self;
}
