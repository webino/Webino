<?php

namespace WebinoAppLib\Log;

use WebinoLogLib\SeverityInterface;

/**
 * Interface MessageInterface
 */
interface MessageInterface extends SeverityInterface
{
    /**
     * Message severity
     *
     * @return int
     */
    public function getLevel();

    /**
     * Return the log message
     *
     * @param mixed ...$args Message arguments
     * @return mixed
     */
    public function getMessage(...$args);
}
