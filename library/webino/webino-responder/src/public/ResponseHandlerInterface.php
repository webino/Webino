<?php

namespace Webino;

/**
 * Interface ResponseHandlerInterface
 * @package webino-responder
 */
interface ResponseHandlerInterface
{
    /**
     * @param Event $event
     */
    function __invoke(Event $event);
}
