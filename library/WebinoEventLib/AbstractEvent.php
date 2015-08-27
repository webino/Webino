<?php

namespace WebinoEventLib;

use WebinoEventLib\Exception;
use Zend\EventManager\Event as BaseEvent;

/**
 * Class AbstractEvent
 */
class AbstractEvent extends BaseEvent implements
    EventInterface
{
    /**
     * {@inheritdoc}
     */
    public function __construct($name = null, $target = null, $params = null)
    {
        if (null !== $name) {
            $this->setName($name);
        }

        if (null !== $target) {
            $this->setTarget($target);
        }

        if (null !== $params) {
            $this->setEventParams($params);
        }
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
     * @return Event
     */
    public function setEventParam($name, $value)
    {
        return parent::setParam($name, $value);
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
     * @return Event
     * @throws Exception\InvalidArgumentException
     */
    public function setEventParams($params)
    {
        return parent::setParams($params);
    }
}
