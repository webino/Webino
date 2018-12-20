<?php

namespace Webino\HttpStatus;

use Webino\AbstractHttpStatus;

/**
 * Class MethodNotAllowed
 * @package webino-http
 */
class MethodNotAllowed extends AbstractHttpStatus
{
    use V10Trait;

    /**
     * {@inheritdoc}
     */
    function getCode(): int
    {
        return 405;
    }

    /**
     * {@inheritdoc}
     */
    function getPhrase(): string
    {
        return 'Method Not Allowed';
    }
}
