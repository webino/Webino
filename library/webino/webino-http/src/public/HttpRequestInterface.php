<?php

namespace Webino;

/**
 * Interface HttpRequestInterface
 * @package webino-http
 */
interface HttpRequestInterface extends \Traversable
{
    /**
     * Return route path
     *
     * @return string
     */
    function getRoutePath(): string;

    /**
     * Return HTTP request method
     *
     * @return string
     */
    function getMethod(): string;
}
