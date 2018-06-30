<?php

namespace Webino\HttpStatus;

use Webino\AbstractHttpStatus;

/**
 * Class Ok
 */
class Ok extends AbstractHttpStatus
{
    use V10Trait;

    /**
     * {@inheritdoc}
     */
    public function getCode(): int
    {
        return 200;
    }

    /**
     * {@inheritdoc}
     */
    public function getPhrase(): string
    {
        return 'OK';
    }
}
