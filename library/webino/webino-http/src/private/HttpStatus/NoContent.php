<?php

namespace Webino\HttpStatus;

use Webino\AbstractHttpStatus;

/**
 * Class NoContent
 * @package webino-http
 */
class NoContent extends AbstractHttpStatus
{
    use V10Trait;

    /**
     * {@inheritdoc}
     */
    function getCode(): int
    {
        return 204;
    }

    /**
     * {@inheritdoc}
     */
    function getPhrase(): string
    {
        return 'No Content';
    }
}
