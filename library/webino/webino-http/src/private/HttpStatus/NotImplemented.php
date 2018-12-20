<?php

namespace Webino\HttpStatus;

use Webino\AbstractHttpStatus;

/**
 * Class NotImplemented
 * @package webino-http
 */
class NotImplemented extends AbstractHttpStatus
{
    use V10Trait;

    /**
     * {@inheritdoc}
     */
    function getCode(): int
    {
        return 501;
    }

    /**
     * {@inheritdoc}
     */
    function getPhrase(): string
    {
        return 'Not Implemented';
    }
}
