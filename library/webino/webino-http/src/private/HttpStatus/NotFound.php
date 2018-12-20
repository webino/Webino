<?php

namespace Webino\HttpStatus;

use Webino\AbstractHttpStatus;

/**
 * Class NotFound
 * @package webino-http
 */
class NotFound extends AbstractHttpStatus
{
    use V10Trait;

    /**
     * {@inheritdoc}
     */
    function getCode(): int
    {
        return 404;
    }

    /**
     * {@inheritdoc}
     */
    function getPhrase(): string
    {
        return 'Not Found';
    }
}
