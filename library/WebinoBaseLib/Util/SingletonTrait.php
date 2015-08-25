<?php

namespace WebinoBaseLib\Util;

/**
 * Class SingletonTrait
 */
trait SingletonTrait
{
    /**
     * @var $this
     */
    private static $instance;

    /**
     * @return $this
     */
    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }
}
