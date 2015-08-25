<?php

namespace WebinoLogLib\Message;

use WebinoLogLib\SeverityInterface;
use Zend\Stdlib\Parameters;

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
     * @param Parameters $args Message arguments
     * @return mixed
     */
    public function getMessage(Parameters $args);
}
