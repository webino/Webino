<?php

namespace Webino\HttpStatus;

use Webino\AbstractHttpStatus;

/**
 * Class BadRequest
 */
class BadRequest extends AbstractHttpStatus
{
    use V10Trait;

    /**
     * {@inheritdoc}
     */
    public function getCode(): int
    {
        return 400;
    }

    /**
     * {@inheritdoc}
     */
    public function getPhrase(): string
    {
        return 'Bad Request';
    }
}
