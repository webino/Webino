<?php

namespace WebinoLogLib\Message;

/**
 * Class AbstractAlertMessage
 */
abstract class AbstractAlertMessage implements MessageInterface
{
    /**
     * Message severity
     *
     * @return int
     */
    public function getLevel()
    {
        return $this::ALERT;
    }
}
