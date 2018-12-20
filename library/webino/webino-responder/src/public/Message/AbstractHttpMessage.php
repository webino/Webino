<?php

namespace Webino;

/**
 * Class AbstractHttpMessage
 * @package webino-responder
 */
abstract class AbstractHttpMessage extends AbstractMessage
{
    /**
     * @var HttpHeadersInterface
     */
    protected $headers;

    /**
     * Return HTTP headers
     *
     * @return HttpHeadersInterface
     */
    function getHeaders(): HttpHeadersInterface
    {
        return $this->headers;
    }

    /**
     * Set HTTP headers
     *
     * @param HttpHeadersInterface $headers
     * @return $this
     */
    function setHeaders(HttpHeadersInterface $headers)
    {
        $this->headers = $headers;
        return $this;
    }
}
