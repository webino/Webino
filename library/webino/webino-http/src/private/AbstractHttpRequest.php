<?php

namespace Webino;

/**
 * Class AbstractHttpRequest
 * @package webino-http
 */
abstract class AbstractHttpRequest implements \IteratorAggregate, \ArrayAccess, HttpRequestInterface
{
    use HttpContextTrait;

    /**
     * @var HttpServerInterface
     */
    private $server;

    /**
     * @var HttpBasePathInterface
     */
    private $basePath;

    /**
     * @var HttpRequestUri
     */
    private $requestUri;

    /**
     * @param HttpServerInterface $server
     * @param HttpBasePathInterface $basePath
     * @param HttpRequestUriInterface $requestUri
     */
    public function __construct(
        HttpServerInterface $server,
        HttpBasePathInterface $basePath,
        HttpRequestUriInterface $requestUri
    ) {
        $this->server = $server;
        $this->basePath = $basePath;
        $this->requestUri = $requestUri;
    }

    /**
     * Return route path
     *
     * @return string
     */
    abstract function getRoutePath(): string;

    /**
     * Returns HTTP server
     *
     * @return HttpServerInterface
     */
    public function getServer(): HttpServerInterface
    {
        return $this->server;
    }

    /**
     * Returns HTTP root
     *
     * @return HttpBasePathInterface
     */
    function getBasePath(): HttpBasePathInterface
    {
        return $this->basePath;
    }

    /**
     * Returns request URL
     *
     * @return HttpRequestUriInterface
     */
    function getRequestUri(): HttpRequestUriInterface
    {
        return $this->requestUri;
    }

    /**
     * @return iterable
     */
    public function getIterator(): iterable
    {
        return $this;
    }
}
