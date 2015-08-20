<?php

namespace WebinoLogLib;

use WebinoLogLib\Message\MessageInterface;

/**
 * Interface LoggerInterface
 */
interface LoggerInterface extends SeverityInterface
{
    /**
     * Write a message to a log
     *
     * @param string|MessageInterface $level Message severity or a MessageInterface class name or an object.
     * @param mixed ...$args Message parameters, if $level is a string the first argument is a message text.
     * @return \Psr\Log\LoggerInterface
     */
    public function log($level = null, ...$args);
}
