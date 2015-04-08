<?php

namespace WebinoAppLib\Application\Traits;

use Psr\Log\LoggerInterface;

/**
 * Trait Logger
 */
trait LoggerTrait
{
    /**
     * @return LoggerInterface
     */
    abstract public function getLogger();

    /**
     * Write a message to a log
     *
     * @param $level|MessageInterface|null Message severity or a MessageInterface class name or an object.
     * @param mixed ...$args Message parameters, if $level is a string the first argument is a message text.
     * @return LoggerInterface
     */
    public function log($level = null, ...$args)
    {
        return $this->getLogger()->log($level, ...$args);
    }
}
