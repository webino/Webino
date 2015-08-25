<?php

namespace WebinoAppLib\Event;

use WebinoAppLib\Application\AbstractApplication;

/**
 * Class AppEventTrait
 */
trait AppEventTrait
{
    /**
     * @var AbstractApplication
     */
    private $app;

    /**
     * Get the event target
     *
     * This may be either an object, or the name of a static method.
     *
     * @return string|object
     */
    abstract public function getTarget();

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
