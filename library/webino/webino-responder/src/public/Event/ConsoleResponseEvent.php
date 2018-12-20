<?php

namespace Webino;

/**
 * Class ConsoleResponseEvent
 * @package webino-responder
 */
class ConsoleResponseEvent extends ResponseEvent
{
    /**
     * Greater than zero is error
     *
     * @var int
     */
    protected $exitCode = 0;

    /**
     * Return command exit code
     *
     * @return int
     */
    function getExitCode(): int
    {
        return $this->exitCode;
    }

    /**
     * Set command exit code
     *
     * @param int $exitCode
     * @return $this
     */
    function setExitCode(int $exitCode)
    {
        $this->exitCode = $exitCode;
        return $this;
    }
}