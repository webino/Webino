<?php

namespace Webino\HttpStatus;

use Webino\AbstractHttpStatus;

/**
 * Class NotAcceptable
 * @package webino-http
 */
class NotAcceptable extends AbstractHttpStatus
{
    use V10Trait;

    /**
     * {@inheritdoc}
     */
    function getCode(): int
    {
        return 406;
    }

    /**
     * {@inheritdoc}
     */
    function getPhrase(): string
    {
        return 'Not Acceptable';
    }
}
