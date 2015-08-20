<?php

namespace WebinoLogLib;

/**
 * Class LoggerAwareTrait
 */
trait LoggerAwareTrait
{
    /**
     * @var LoggerInterface
     */
    private $logger = null;

    /**
     * Set logger object
     *
     * @param LoggerInterface $logger
     * @return $this
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
        return $this;
    }

    /**
     * Get logger object
     *
     * @return LoggerInterface|null
     */
    protected function getLogger()
    {
        return $this->logger;
    }
}
