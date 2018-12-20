<?php

namespace Webino;

/**
 * Interface HttpEventInterface
 * @package webino-http
 */
interface HttpEventInterface
{
    /**
     * Return HTTP status code
     *
     * @return HttpStatusInterface
     */
    function getStatus(): HttpStatusInterface;

    /**
     * Set HTTP status code
     *
     * @param HttpStatusInterface $status
     * @return $this
     */
    function setStatus(HttpStatusInterface $status);

    /**
     * Returns response headers
     *
     * @return HttpHeadersInterface
     */
    function getHeaders(): HttpHeadersInterface;

    /**
     * Set response headers
     *
     * @param HttpHeadersInterface $headers
     * @return $this
     */
    function setHeaders(HttpHeadersInterface $headers);

    /**
     * @return HttpRequestInterface
     */
    function getRequest(): HttpRequestInterface;

    /**
     * @param HttpRequestInterface $request
     */
    function setRequest(HttpRequestInterface $request): void;

    /**
     * Returns response
     *
     * @return mixed
     */
    function getResponse();

    /**
     * Set response
     *
     * @param mixed $response
     */
    function setResponse($response): void;
}
