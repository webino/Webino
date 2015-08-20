<?php

namespace WebinoLogLib\Message;

/**
 * Class AbstractDebugMessage
 */
abstract class AbstractDebugMessage implements MessageInterface
{
    /**
     * Message severity
     *
     * @return int
     */
    public function getLevel()
    {
        return $this::DEBUG;
    }
}
