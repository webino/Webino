<?php

namespace ExampleModule\Action;

use Zend\EventManager\Event;

/**
 * Class Example
 */
class Example
{
    /**
     * @param Event $event
     */
    public function __invoke(Event $event)
    {
        return 'Example Module Action';
    }
}