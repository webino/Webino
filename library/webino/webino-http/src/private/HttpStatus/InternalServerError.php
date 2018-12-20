<?php

namespace Webino\HttpStatus;

use Webino\AbstractHttpStatus;

/**
 * Class InternalServerError
 * @package webino-http
 */
class InternalServerError extends AbstractHttpStatus
{
    use V10Trait;

    /**
     * {@inheritdoc}
     */
    function getCode(): int
    {
        return 500;
    }

    /**
     * {@inheritdoc}
     */
    function getPhrase(): string
    {
        return 'Internal Server Error';
    }
}
