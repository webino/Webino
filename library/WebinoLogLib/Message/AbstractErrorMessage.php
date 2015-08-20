<?php

namespace WebinoLogLib\Message;

/**
 * Class AbstractErrorMessage
 */
abstract class AbstractErrorMessage implements MessageInterface
{
    /**
     * Message severity
     *
     * @return int
     */
    public function getLevel()
    {
        return $this::ERROR;
    }
}
