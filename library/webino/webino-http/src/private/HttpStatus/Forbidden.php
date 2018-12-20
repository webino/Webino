<?php

namespace Webino\HttpStatus;

use Webino\AbstractHttpStatus;

/**
 * Class Forbidden
 * @package webino-http
 */
class Forbidden extends AbstractHttpStatus
{
    use V10Trait;

    /**
     * {@inheritdoc}
     */
    function getCode(): int
    {
        return 403;
    }

    /**
     * {@inheritdoc}
     */
    function getPhrase(): string
    {
        return 'Forbidden';
    }
}
