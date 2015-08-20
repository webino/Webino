<?php

namespace WebinoLogLib\Message;

/**
 * Class AbstractCriticalMessage
 */
abstract class AbstractCriticalMessage implements MessageInterface
{
    /**
     * Message severity
     *
     * @return int
     */
    public function getLevel()
    {
        return $this::CRITICAL;
    }
}
