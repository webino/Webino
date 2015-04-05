<?php

namespace WebinoAppLib\Log;

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
