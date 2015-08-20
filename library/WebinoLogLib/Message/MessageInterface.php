<?php

namespace WebinoLogLib\Message;

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
     * @param array $args Message arguments
     * @return mixed
     */
    public function getMessage(array $args);
}
