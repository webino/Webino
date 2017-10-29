<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoEventLib;

use WebinoEventLib\Exception;
use Zend\EventManager\Event as BaseEvent;

/**
 * Class AbstractEvent
 */
class AbstractEvent extends BaseEvent implements EventInterface
{
    /**
     * {@inheritdoc}
     */
    public function __construct($name = null, $target = null, $params = null)
    {
        parent::__construct($name, $target, null);
        $params and $this->setEventParams($params);
    }

    /**
     * Get an individual parameter
     *
     * If the parameter does not exist, the $default value will be returned.
     *
     * @param  string|int $name
     * @param  mixed $default
     * @return mixed
     */
    public function getEventParam($name, $default = null)
    {
        return parent::getParam($name, $default);
    }

    /**
     * Set an individual parameter to a value
     *
     * @param  string|int $name
     * @param  mixed $value
     * @return $this
     */
    public function setEventParam($name, $value)
    {
        parent::setParam($name, $value);
        return $this;
    }

    /**
     * Get all parameters
     *
     * @return array|object|\ArrayAccess
     */
    public function getEventParams()
    {
        return parent::getParams();
    }

    /**
     * Set parameters
     *
     * Overwrites parameters
     *
     * @param  array|\ArrayAccess|object $params
     * @return $this
     * @throws Exception\InvalidArgumentException
     */
    public function setEventParams($params)
    {
        parent::setParams($params);
        return $this;
    }
}
