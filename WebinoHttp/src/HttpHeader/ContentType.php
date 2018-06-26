<?php

namespace Webino\HttpHeader;

use Webino\AbstractHttpHeader;

/**
 * Class ContentType
 */
class ContentType extends AbstractHttpHeader
{
    /**
     * {@inheritDoc}
     */
    public function getName() : string
    {
        return 'Content-type';
    }
}
