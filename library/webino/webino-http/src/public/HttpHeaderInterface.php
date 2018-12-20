<?php

namespace Webino;

/**
 * Interface HttpHeaderInterface
 * @package webino-http
 */
interface HttpHeaderInterface
{
    /**
     * Return header name
     *
     * @return string
     */
    function getName(): string;

    /**
     * Return header value
     *
     * @return string
     */
    function getValue(): string;

    /**
     * Send a HTTP header
     *
     * @return void
     */
    function send();
}
