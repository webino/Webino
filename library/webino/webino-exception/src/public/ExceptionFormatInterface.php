<?php

namespace Webino;

/**
 * Interface ExceptionFormatInterface
 * @package webino-exception
 */
interface ExceptionFormatInterface
{
    /**
     * Format the exception message
     *
     * @param array $params Message parameters
     * @return $this
     */
    function format(...$params);
}
