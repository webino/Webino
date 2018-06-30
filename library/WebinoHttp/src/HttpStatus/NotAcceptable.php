<?php

namespace Webino\HttpStatus;

use Webino\AbstractHttpStatus;

/**
 * Class NotAcceptable
 */
class NotAcceptable extends AbstractHttpStatus
{
    use V10Trait;

    /**
     * {@inheritdoc}
     */
    public function getCode(): int
    {
        return 406;
    }

    /**
     * {@inheritdoc}
     */
    public function getPhrase(): string
    {
        return 'Not Acceptable';
    }
}
