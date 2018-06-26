<?php

namespace Webino\Exception;

/**
 * Interface ExceptionFormatInterface
 */
interface ExceptionFormatInterface
{
    /**
     * Format the exception message
     *
     * @param array $params Message parameters
     * @return $this
     */
    public function format(...$params);
}
