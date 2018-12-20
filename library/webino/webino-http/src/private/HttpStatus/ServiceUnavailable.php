<?php

namespace Webino\HttpStatus;

use Webino\AbstractHttpStatus;

/**
 * Class ServiceUnavailable
 * @package webino-http
 */
class ServiceUnavailable extends AbstractHttpStatus
{
    use V10Trait;

    /**
     * {@inheritdoc}
     */
    function getCode(): int
    {
        return 503;
    }

    /**
     * {@inheritdoc}
     */
    function getPhrase(): string
    {
        return 'Service Unavailable';
    }
}
