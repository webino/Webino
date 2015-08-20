<?php

namespace WebinoLogLib\Message;

/**
 * Class AbstractInfoMessage
 */
abstract class AbstractInfoMessage implements MessageInterface
{
    /**
     * Message severity
     *
     * @return int
     */
    public function getLevel()
    {
        return $this::INFO;
    }
}
