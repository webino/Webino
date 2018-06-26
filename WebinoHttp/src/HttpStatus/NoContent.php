<?php

namespace Webino\HttpStatus;

use Webino\AbstractHttpStatus;

/**
 * Class NoContent
 */
class NoContent extends AbstractHttpStatus
{
    use V10Trait;

    /**
     * {@inheritdoc}
     */
    public function getCode() : int
    {
        return 204;
    }

    /**
     * {@inheritdoc}
     */
    public function getPhrase() : string
    {
        return 'No Content';
    }
}
