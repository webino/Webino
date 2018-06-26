<?php

namespace Webino\HttpStatus;

use Webino\AbstractHttpStatus;

/**
 * Class InternalServerError
 */
class InternalServerError extends AbstractHttpStatus
{
    use V10Trait;

    /**
     * {@inheritdoc}
     */
    public function getCode(): int
    {
        return 500;
    }

    /**
     * {@inheritdoc}
     */
    public function getPhrase(): string
    {
        return 'Internal Server Error';
    }
}
