<?php

namespace WebinoAppLib\Contract;

use WebinoLogLib\LoggerInterface as BaseLoggerInterface;

/**
 * Interface LoggerInterface
 */
interface LoggerInterface extends BaseLoggerInterface
{
    /**
     * @param string $name
     * @return object|\WebinoLogLib\LoggerInterface
     */
    public function getLogger($name = null);

    /**
     * Write a message to a log
     *
     * @param string|\WebinoLogLib\Message\MessageInterface|null $level Message severity or a MessageInterface
     *  class name or an object.
     * @param mixed ...$args Message parameters, if $level is a string the first argument is a message text.
     * @return \Psr\Log\LoggerInterface
     */
    public function log($level = null, ...$args);
}
