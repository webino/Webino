<?php

namespace Webino;

use Webino\HttpHeader\ContentType;

/**
 * Interface HttpResponseInterface
 */
interface HttpResponseInterface
{
    /**
     * Return response content type
     *
     * @return ContentType
     */
    public function getContentType(): ContentType;

    /**
     * Set response content type
     *
     * @param ContentType|string $type Content type
     * @return $this
     */
    public function setContentType($type);
}
