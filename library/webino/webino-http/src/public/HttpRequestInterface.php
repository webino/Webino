<?php

namespace Webino;

/**
 * Interface HttpRequestInterface
 * @package webino-http
 */
interface HttpRequestInterface extends \Traversable
{
    /**
     * Returns route path
     *
     * @return string
     */
    function getRoutePath(): string;

    /**
     * Returns HTTP request method
     *
     * @return string
     */
    function getMethod(): string;

    /**
     * Returns HTTP host name
     *
     * @return string
     */
    function getHost(): string;

    /**
     * Returns HTTP request scheme
     *
     * @return string
     */
    function getScheme(): string;

    /**
     * Returns true when request scheme is HTTPS
     *
     * @return bool
     */
    function isHttps(): bool;

    /**
     * Returns HTTP request port
     *
     * @return string
     */
    function getPort(): string;

    /**
     * Returns HTTP request query string
     *
     * @return string
     */
    function getQueryString(): string;

    /**
     * Returns HTTP server
     *
     * @return HttpServerInterface
     */
    function getServer(): HttpServerInterface;

    /**
     * Returns HTTP root
     *
     * @return HttpBasePathInterface
     */
    function getBasePath(): HttpBasePathInterface;

    /**
     * Returns request URL
     *
     * @return HttpRequestUriInterface
     */
    function getRequestUri(): HttpRequestUriInterface;
}
