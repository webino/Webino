<?php

namespace Webino\Handler;

use Webino\Event;

/**
 * Interface ResponseHandlerInterface
 */
interface ResponseHandlerInterface
{
    /**
     * @param Event $event
     */
    public function __invoke(Event $event);
}
