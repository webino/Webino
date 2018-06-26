<?php

namespace Webino\HttpStatus;

use Webino\AbstractHttpStatus;

/**
 * Class MethodNotAllowed
 */
class MethodNotAllowed extends AbstractHttpStatus
{
    use V10Trait;

    /**
     * {@inheritdoc}
     */
    public function getCode() : int
    {
        return 405;
    }

    /**
     * {@inheritdoc}
     */
    public function getPhrase() : string
    {
        return 'Method Not Allowed';
    }
}
