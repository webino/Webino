<?php

namespace WebinoEventLib;

use Zend\EventManager\Event as BaseEvent;

/**
 * Class Event
 */
class Event extends BaseEvent
{
    /**
     * The beginning of the event
     */
    const BEGIN = 9000;

    /**
     * Before main event
     */
    const BEFORE = 5000;

    /**
     * After main event
     */
    const AFTER = -5000;

    /**
     * At the end of an event
     */
    const FINISH = -9000;

    /**
     * Event priority offset
     */
    const OFFSET = 10;

    /**
     * @param string|self|null $name
     * @param mixed|self|null $target
     * @param array|self|null $params
     */
    public function __construct($name = null, $target = null, $params = null)
    {
        if ($name instanceof self) {
            $this->setTarget($name->getTarget());
            $this->setParams($name->getParams());

        } elseif ($target instanceof self) {
            parent::__construct($name);
            $this->setTarget($target->getTarget());
            $this->setParams($target->getParams());

        } elseif ($params instanceof self) {
            parent::__construct($name, $target);
            $this->setParams($params->getParams());

        } else {
            parent::__construct($name, $target, $params);
        }
    }
}
