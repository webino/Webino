<?php

namespace WebinoLogLib\Message;

/**
 * Class AbstractEmergencyMessage
 */
abstract class AbstractEmergencyMessage implements MessageInterface
{
    /**
     * Message severity
     *
     * @return int
     */
    public function getLevel()
    {
        return $this::EMERGENCY;
    }
}
