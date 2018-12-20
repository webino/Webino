<?php

namespace Webino;

/**
 * Class AbstractHttpStatus
 * @package webino-http
 */
interface HttpStatusInterface
{
    /**
     * Return status code
     *
     * @return int
     */
    function getCode(): int;

    /**
     * Return status phrase
     *
     * @return string
     */
    function getPhrase(): string;

    /**
     * Return status version
     *
     * @return string
     */
    function getVersion(): string;

    /**
     * Send a response code header
     *
     * @return void
     */
    function send(): void;
}
