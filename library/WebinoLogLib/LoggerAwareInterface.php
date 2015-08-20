<?php

namespace WebinoLogLib;

/**
 * Interface LoggerAwareInterface
 */
interface LoggerAwareInterface
{
    /**
     * Set logger instance
     *
     * @param LoggerInterface $logger
     * @return $this
     */
    public function setLogger(LoggerInterface $logger);
}
