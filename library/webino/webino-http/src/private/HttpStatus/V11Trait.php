<?php

namespace Webino\HttpStatus;

/**
 * Trait HttpStatusV11Trait
 * @package webino-http
 */
trait V11Trait
{
    /**
     * {@inheritdoc}
     */
    function getVersion(): string
    {
        return '1.1';
    }
}
