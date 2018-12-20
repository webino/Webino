<?php

namespace Webino;

/**
 * Class AppEvent
 * @package webino-app
 */
class AppEvent extends Event
{
    /**
     * @return App
     */
    function getApp(): App
    {
        /** @var App $target */
        $target = $this->getTarget();
        return $target;
    }
}
