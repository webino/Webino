<?php

namespace Webino\HttpStatus;

use Webino\AbstractHttpStatus;

/**
 * Class Ok
 * @package webino-http
 */
class Ok extends AbstractHttpStatus
{
    use V10Trait;

    /**
     * {@inheritdoc}
     */
    function getCode(): int
    {
        return 200;
    }

    /**
     * {@inheritdoc}
     */
    function getPhrase(): string
    {
        return 'OK';
    }
}
