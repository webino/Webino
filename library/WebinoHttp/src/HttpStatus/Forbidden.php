<?php

namespace Webino\HttpStatus;

use Webino\AbstractHttpStatus;

/**
 * Class Forbidden
 */
class Forbidden extends AbstractHttpStatus
{
    use V10Trait;

    /**
     * {@inheritdoc}
     */
    public function getCode(): int
    {
        return 403;
    }

    /**
     * {@inheritdoc}
     */
    public function getPhrase(): string
    {
        return 'Forbidden';
    }
}
