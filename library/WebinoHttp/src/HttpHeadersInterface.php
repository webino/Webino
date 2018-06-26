<?php

namespace Webino;

/**
 * Interface HttpHeadersInterface
 */
interface HttpHeadersInterface
{
    /**
     * Set HTTP header
     *
     * @param HttpHeaderInterface $header
     * @return $this
     */
    public function set(HttpHeaderInterface $header);

    /**
     * Send headers
     *
     * @return void
     */
    public function send();
}
