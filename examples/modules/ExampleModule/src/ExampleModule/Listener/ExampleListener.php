<?php

namespace ExampleModule\Listener;

use Webino\Application;
use Webino\Application\Listener\AbstractActionListener;
use Zend\EventManager\Event;

class ExampleListener extends AbstractActionListener
{
    /**
     * @param Event $event
     * @return string
     */
    public function onAction(Event $event)
    {
        return 'Example module response content';
    }
}
