<?php

namespace Webino;

/**
 * Class HttpRequestUri
 * @package webino-http
 */
class HttpRequestUri implements HttpRequestUriInterface
{
    /**
     * HTTP request URI
     *
     * @var string
     */
    private $uri;

    /**
     * @var HttpServerInterface
     */
    private $httpServer;

    /**
     * @param CreateInstanceEventInterface $event
     * @return HttpRequestUri
     */
    static function create(CreateInstanceEventInterface $event): HttpRequestUri
    {
        $container = $event->getContainer();
        $httpServer = $container->get(HttpServerInterface::class);
        return new static($httpServer);
    }

    /**
     * @param HttpServerInterface $httpServer
     */
    function __construct(HttpServerInterface $httpServer)
    {
        $this->httpServer = $httpServer;
    }

    /**
     * @return string
     */
    function __toString(): string
    {
        $this->uri or $this->uri = $this->createUri();
        return $this->uri;
    }

    /**
     * @return string
     */
    protected function createUri(): string
    {
        $requestUri = null;
        $server = $this->httpServer;

        // IIS7 with URL Rewrite: make sure we get the unencoded url
        // (double slash problem).
        $iisUrlRewritten = $server['IIS_WasUrlRewritten'] ?? '';
        $unencodedUrl = $server['UNENCODED_URL'] ?? '';

        if ('1' == $iisUrlRewritten && '' !== $unencodedUrl) {
            return $unencodedUrl;
        }

        $requestUri = $server['REQUEST_URI'] ?? '';

        // HTTP proxy requests setup request URI with scheme and host [and port]
        // + the URL path, only use URL path.
        if ($requestUri !== null) {
            return preg_replace('#^[^/:]+://[^/]+#', '', $requestUri);
        }

        // IIS 5.0, PHP as CGI.
        $origPathInfo = $server['ORIG_PATH_INFO'] ?? '';
        if ($origPathInfo !== null) {
            $queryString = $server['QUERY_STRING'] ?? '';
            if ($queryString !== '') {
                $origPathInfo .= '?' . $queryString;
            }
            return $origPathInfo;
        }

        // last resort
        return '/';
    }
}
