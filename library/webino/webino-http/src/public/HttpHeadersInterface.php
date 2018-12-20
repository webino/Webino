<?php

namespace Webino;

/**
 * Interface HttpHeadersInterface
 * @package webino-http
 */
interface HttpHeadersInterface
{
    /**
     * Set HTTP header
     *
     * @param HttpHeaderInterface $header
     * @return $this
     */
    function set(HttpHeaderInterface $header);

    /**
     * Send headers
     *
     * @return void
     */
    function send();
}
