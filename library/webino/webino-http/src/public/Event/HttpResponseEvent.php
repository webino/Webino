<?php

namespace Webino;

use Webino\HttpStatus;

/**
 * Class HttpResponseEvent
 * @package webino-http
 */
class HttpResponseEvent extends ResponseEvent implements HttpEventInterface
{
    use HttpRequestEventTrait;

    /**
     * @var HttpStatusInterface
     */
    protected $status;

    /**
     * @var HttpHeadersInterface
     */
    protected $headers;

    /**
     * @var mixed
     */
    protected $response;

    /**
     * Return HTTP status code
     *
     * @return HttpStatusInterface
     */
    function getStatus(): HttpStatusInterface
    {
        if (empty($this['status'])) {
            $this->setStatus(new HttpStatus\Ok);
        }
        return $this['status'];
    }

    /**
     * Set HTTP status code
     *
     * @param HttpStatusInterface $status
     * @return $this
     */
    function setStatus(HttpStatusInterface $status)
    {
        $this['status'] = $status;
        return $this;
    }

    /**
     * Returns response headers
     *
     * @return HttpHeadersInterface
     */
    function getHeaders(): HttpHeadersInterface
    {
        if (empty($this['headers'])) {
            $this->setHeaders(new HttpHeaders);
        }
        return $this['headers'];
    }

    /**
     * Set response headers
     *
     * @param HttpHeadersInterface $headers
     * @return $this
     */
    function setHeaders(HttpHeadersInterface $headers)
    {
        $this['headers'] = $headers;
        return $this;
    }

    /**
     * Returns response
     *
     * @return mixed
     */
    function getResponse()
    {
        return $this['response'] ?? null;
    }

    /**
     * Set response
     *
     * @param mixed $response
     */
    function setResponse($response): void
    {
        $this['response'] = $response;
    }
}
