<?php

namespace Webino;

use Webino\HttpHeader\ContentType;

/**
 * Interface HttpResponseInterface
 * @package webino-http
 */
interface HttpResponseInterface
{
    /**
     * Return response content type
     *
     * @return ContentType
     */
    function getContentType(): ContentType;

    /**
     * Set response content type
     *
     * @param ContentType|string $type Content type
     * @return $this
     */
    function setContentType($type);
}
