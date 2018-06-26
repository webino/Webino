<?php

namespace Webino;

/**
 * Class IsConsole
 */
class IsConsole
{
    /**
     * @return bool
     */
    public function __invoke() : bool
    {
        return 'cli' === PHP_SAPI;
    }
}
