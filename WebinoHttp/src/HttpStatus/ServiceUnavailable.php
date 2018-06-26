<?php

namespace Webino\HttpStatus;

use Webino\AbstractHttpStatus;

/**
 * Class ServiceUnavailable
 */
class ServiceUnavailable extends AbstractHttpStatus
{
    use V10Trait;

    /**
     * {@inheritdoc}
     */
    public function getCode(): int
    {
        return 503;
    }

    /**
     * {@inheritdoc}
     */
    public function getPhrase(): string
    {
        return 'Service Unavailable';
    }
}
