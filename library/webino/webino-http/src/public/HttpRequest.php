<?php

namespace Webino;

/**
 * Class HttpRequest
 * @package webino-http
 */
class HttpRequest extends AbstractHttpRequest
{
    /**
     * @param CreateInstanceEventInterface $event
     * @return HttpRequest
     */
    static function create(CreateInstanceEventInterface $event): HttpRequest
    {
        $container = $event->getContainer();
        $server = $container->get(HttpServerInterface::class);
        $basePath = $container->get(HttpBasePathInterface::class);
        $requestUri = $container->get(HttpRequestUri::class);
        return new static($server, $basePath, $requestUri);
    }

    /**
     * Returns request route path
     *
     * @return string
     */
    function getRoutePath(): string
    {
        $basePath = (string) $this->getBasePath();
        $requestUri = (string) $this->getRequestUri();
        $requestQuery = trim(substr($requestUri, strlen($basePath)), '/?&');
        return explode('&', $requestQuery ?? '', 2)[0] ?? '';
    }

    /**
     * Returns HTTP request method
     *
     * @return string
     */
    function getMethod(): string
    {
        $server = $this->getServer();
        return strtolower($server['REQUEST_METHOD']);
    }

    /**
     * Returns HTTP host name
     *
     * @return string
     */
    function getHost(): string
    {
        $server = $this->getServer();
        return strtolower($server['SERVER_NAME'] ?? explode(':', $server['HTTP_HOST'] ?? '')[0]);
    }

    /**
     * Returns HTTP request scheme
     *
     * @return string
     */
    function getScheme(): string
    {
        $server = $this->getServer();
        $scheme = $server['REQUEST_SCHEME'] ?? (0 === strpos('HTTPS', $server['SERVER_PROTOCOL']) ? 'https' : 'http');
        return strtolower($scheme);
    }

    /**
     * Returns true when request scheme is HTTPS
     *
     * @return bool
     */
    function isHttps(): bool
    {
        return $this->getScheme() === 'https';
    }

    /**
     * Returns HTTP request port
     *
     * @return string
     */
    function getPort(): string
    {
        $server = $this->getServer();
        return $server['SERVER_PORT'] ?? '80';
    }

    /**
     * Returns HTTP request query string
     *
     * @return string
     */
    function getQueryString(): string
    {
        $server = $this->getServer();
        return $server['QUERY_STRING'] ?? '';
    }

    /**
     * @return iterable
     */
    protected function createParams(): iterable
    {
        return $_REQUEST;
    }
}
