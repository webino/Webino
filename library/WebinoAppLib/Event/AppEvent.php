<?php

namespace WebinoAppLib\Event;

use WebinoAppLib\Application\AbstractApplication;
use WebinoEventLib\Event;

/**
 * Class AppEvent
 */
class AppEvent extends Event implements
    AppEventInterface
{
    /**
     * @var AbstractApplication
     */
    private $app;

    /**
     * @return AbstractApplication
     */
    public function getApp()
    {
        $target = $this->getTarget();
        if (null === $this->app && $target instanceof AbstractApplication) {
            $this->setApp($target);
        }
        return $this->app;
    }

    /**
     * @param AbstractApplication $app
     * @return $this
     */
    protected function setApp(AbstractApplication $app)
    {
        $this->app = $app;
        return $this;
    }
}
