<?php

namespace WebinoAppLib\Application\Traits;

use WebinoAppLib\Service\LoggerInterface;

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
     * @param $level|MessageInterface|null Message severity or a MessageInterface class name or an object.
     * @param mixed ...$args Message parameters, if $level is a string the first argument is a message text.
     * @return LoggerInterface
     */
    public function log($level = null, ...$args)
    {
        return $this->getLogger()->log($level, ...$args);
    }
}
