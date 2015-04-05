<?php

namespace WelcomeModule\Action;

use Webino\Markdown\View\Markdown;
use Webino\View\Text;
use Zend\EventManager\Event;

/**
 * Class Home
 */
class Home
{
    /**
     * @param Event $event
     * @return string
     */
    public function __invoke(Event $event)
    {
//        return new Text(json_encode(['content' => '# Welcome To the Webino Platform!']));
//        return new Text('# Welcome To the Webino Platform!');
        return new Markdown('# Welcome To the Webino Platform!');
    }
}