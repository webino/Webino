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
     * Return request route path
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
     * Return HTTP request method
     *
     * @return string
     */
    function getMethod(): string
    {
        $server = $this->getServer();
        return strtolower($server['REQUEST_METHOD']);
    }

    /**
     * @return iterable
     */
    protected function createParams(): iterable
    {
        return $_REQUEST;
    }
}
