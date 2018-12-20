<?php

namespace Webino;

/**
 * Class IsConsole
 * @package webino-console
 */
class IsConsole
{
    /**
     * @return bool
     */
    function __invoke(): bool
    {
        return 'cli' === PHP_SAPI;
    }
}
