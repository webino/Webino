<?php

namespace Webino\HttpStatus;

use Webino\AbstractHttpStatus;

/**
 * Class NotImplemented
 */
class NotImplemented extends AbstractHttpStatus
{
    use V10Trait;

    /**
     * {@inheritdoc}
     */
    public function getCode(): int
    {
        return 501;
    }

    /**
     * {@inheritdoc}
     */
    public function getPhrase(): string
    {
        return 'Not Implemented';
    }
}
