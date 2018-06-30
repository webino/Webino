<?php

namespace Webino;

/**
 * Interface HttpHeaderInterface
 */
interface HttpHeaderInterface
{
    /**
     * Return header name
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Return header value
     *
     * @return string
     */
    public function getValue(): string;

    /**
     * Send a HTTP header
     *
     * @return void
     */
    public function send();
}
