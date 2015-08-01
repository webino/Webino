<?php

namespace WebinoAppLib\Contract;

use WebinoLogLib\SeverityInterface;

/**
 * Interface LoggerInterface
 */
interface LoggerInterface extends SeverityInterface
{
    /**
     * Write a message to a log
     *
     * @param $level|MessageInterface Message severity or a MessageInterface class name or an object.
     * @param mixed ...$args Message parameters, if $level is a string the first argument is a message text.
     * @return LoggerInterface
     */
    public function log($level = null, ...$args);
}
