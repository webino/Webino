<?php

namespace Webino\HttpStatus;

/**
 * Trait HttpStatusV10Trait
 * @package webino-http
 */
trait V10Trait
{
    /**
     * {@inheritdoc}
     */
    function getVersion(): string
    {
        return '1.0';
    }
}
