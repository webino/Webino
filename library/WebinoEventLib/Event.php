<?php

namespace WebinoEventLib;

use WebinoEventLib\Exception;

/**
 * Class Event
 */
class Event extends AbstractEvent
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
}
