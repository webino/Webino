<?php

namespace WebinoAppLib\Application\Traits;

use WebinoAppLib\Contract\LoggerInterface;
use WebinoAppLib\Log\MessageInterface;

/**
 * Trait Logger
 */
trait LoggerTrait
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @return object|LoggerInterface
     */
    public function getLogger()
    {
        return $this->logger;
    }

    /**
     * @param LoggerInterface $logger
     */
    protected function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Write a message to a log
     *
     * @param string|MessageInterface|null $level Message severity or a MessageInterface class name or an object.
     * @param mixed ...$args Message parameters, if $level is a string the first argument is a message text.
     * @return \Psr\Log\LoggerInterface
     */
    public function log($level = null, ...$args)
    {
        return $this->getLogger()->log($level, ...$args);
    }
}
