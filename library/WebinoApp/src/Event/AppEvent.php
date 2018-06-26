<?php

namespace Webino\Event;

use Webino\App;

/**
 * Class AppEvent
 */
class AppEvent extends \Webino\Event
{
    /**
     * @return App
     */
    public function getApp() : App
    {
        /** @var App $target */
        $target = $this->getTarget();
        return $target;
    }
}
