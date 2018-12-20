<?php

namespace Webino\HttpStatus;

use Webino\AbstractHttpStatus;

/**
 * Class BadRequest
 * @package webino-http
 */
class BadRequest extends AbstractHttpStatus
{
    use V10Trait;

    /**
     * {@inheritdoc}
     */
    function getCode(): int
    {
        return 400;
    }

    /**
     * {@inheritdoc}
     */
    function getPhrase(): string
    {
        return 'Bad Request';
    }
}
