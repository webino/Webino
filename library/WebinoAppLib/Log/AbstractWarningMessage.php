<?php

namespace WebinoAppLib\Log;

/**
 * Class AbstractWarningMessage
 */
abstract class AbstractWarningMessage implements MessageInterface
{
    /**
     * Message severity
     *
     * @return int
     */
    public function getLevel()
    {
        return $this::WARNING;
    }
}
