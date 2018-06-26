<?php

namespace Webino\HttpStatus;

use Webino\AbstractHttpStatus;

/**
 * Class NotFound
 */
class NotFound extends AbstractHttpStatus
{
    use V10Trait;

    /**
     * {@inheritdoc}
     */
    public function getCode(): int
    {
        return 404;
    }

    /**
     * {@inheritdoc}
     */
    public function getPhrase(): string
    {
        return 'Not Found';
    }
}
