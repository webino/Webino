<?php

namespace WebinoEventLib;

use WebinoEventLib\Exception;
use Zend\EventManager\Event as BaseEvent;

/**
 * Class Event
 */
class Event extends BaseEvent implements
    EventInterface
{
    /**
     * @param string|self|null $name
     * @param mixed|self|null $target
     * @param array|self|null $params
     */
    public function __construct($name = null, $target = null, $params = null)
    {
        if ($name instanceof self) {
            $this->setTarget($name->getTarget());
            $this->setEventParams($name->getEventParams());

        } elseif ($target instanceof self) {
            parent::__construct($name);
            $this->setTarget($target->getTarget());
            $this->setEventParams($target->getEventParams());

        } elseif ($params instanceof self) {
            parent::__construct($name, $target);
            $this->setEventParams($params->getEventParams());

        } else {
            parent::__construct($name, $target, $params);
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
