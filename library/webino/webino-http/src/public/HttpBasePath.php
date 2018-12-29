<?php

namespace Webino;

/**
 * Class HttpBasePath
 * @package webino-http
 */
class HttpBasePath implements HttpBasePathInterface
{
    /**
     * @var string
     */
    private $basePath;

    /**
     * @var HttpServerInterface
     */
    private $httpServer;

    /**
     * @var HttpRequestUriInterface
     */
    private $requestUri;

    /**
     * @param CreateInstanceEventInterface $event
     * @return HttpBasePath
     */
    static function create(CreateInstanceEventInterface $event): HttpBasePath
    {
        $container = $event->getContainer();
        $httpServer = $container->get(HttpServerInterface::class);
        $requestUri = $container->get(HttpRequestUriInterface::class);
        return new static($httpServer, $requestUri);
    }

    /**
     * @param HttpServerInterface $httpServer
     * @param HttpRequestUriInterface $requestUri
     */
    function __construct(HttpServerInterface $httpServer, HttpRequestUriInterface $requestUri)
    {
        $this->httpServer = $httpServer;
        $this->requestUri = $requestUri;
    }

    /**
     * @return string
     */
    function __toString(): string
    {
        $this->basePath or $this->basePath = $this->createHttpBasePath();
        return $this->basePath;
    }

    /**
     * @see https://github.com/zendframework/zend-http/blob/master/src/PhpEnvironment/Request.php
     * @return string
     */
    protected function createHttpBasePath(): string
    {
        $server = $this->httpServer;

        $filename = $server['SCRIPT_FILENAME'] ?? '';
        $scriptName = $server['SCRIPT_NAME'] ?? '';
        $phpSelf = $server['PHP_SELF'] ?? '';
        $origScriptName = $server['ORIG_SCRIPT_NAME'] ?? '';

        if ($scriptName !== null && basename($scriptName) === $filename) {
            $basePath = $scriptName;

        } elseif ($phpSelf !== null && basename($phpSelf) === $filename) {
            $basePath = $phpSelf;

        } elseif ($origScriptName !== null && basename($origScriptName) === $filename) {
            // 1and1 shared hosting compatibility.
            $basePath = $origScriptName;

        } else {
            // Backtrack up the SCRIPT_FILENAME to find the portion
            // matching PHP_SELF.
            $basePath = '';
            $basename = basename($filename);
            if ($basename) {
                $path = ($phpSelf ? trim($phpSelf, '/') : '');
                $basePos = strpos($path, $basename) ?: 0;
                $basePath .= substr($path, 0, $basePos) . $basename;
            }
        }

        // If the basePath is empty, then simply return it.
        if (empty($basePath)) {
            return '';
        }

        // Does the base URL have anything in common with the request URI?
        $requestUri = (string) $this->requestUri;

        // Full base URL matches.
        if (0 === strpos($requestUri, $basePath)) {
            return $basePath;
        }

        // Directory portion of base path matches.
        $baseDir = '/' . str_replace('\\', '/', dirname($basePath));
        if (0 === strpos($requestUri, $baseDir)) {
            return $baseDir;
        }

        $truncatedRequestUri = $requestUri;
        if (false !== ($pos = strpos($requestUri, '?'))) {
            $truncatedRequestUri = substr($requestUri, 0, $pos);
        }

        // No match whatsoever
        $basename = basename($basePath);
        if (empty($basename) || false === strpos($truncatedRequestUri, $basename)) {
            return '';
        }

        // If using mod_rewrite or ISAPI_Rewrite strip the script filename
        // out of the base path. $pos !== 0 makes sure it is not matching a
        // value from PATH_INFO or QUERY_STRING.
        if (strlen($requestUri) >= strlen($basePath)
            && (false !== ($pos = strpos($requestUri, $basePath)) && $pos !== 0)
        ) {
            $basePath = substr($requestUri, 0, $pos + strlen($basePath));
        }

        return $basePath;
    }
}
