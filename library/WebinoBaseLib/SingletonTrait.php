<?php

namespace WebinoBaseLib;

/**
 * Class SingletonTrait
 */
trait SingletonTrait
{
    /**
     * @var $this
     */
    protected static $instance;

    /**
     * @return $this
     */
    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static;
        }
        return static::$instance;
    }
}
