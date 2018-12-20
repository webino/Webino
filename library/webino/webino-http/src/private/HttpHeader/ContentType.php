<?php

namespace Webino\HttpHeader;

use Webino\AbstractHttpHeader;

/**
 * Class ContentType
 * @package webino-http
 */
class ContentType extends AbstractHttpHeader
{
    /**
     * {@inheritDoc}
     */
    function getName(): string
    {
        return 'Content-type';
    }
}
