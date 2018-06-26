<?php

namespace Webino;

/**
 * Class AbstractHttpMessage
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
    public function getHeaders(): HttpHeadersInterface
    {
        return $this->headers;
    }

    /**
     * Set HTTP headers
     *
     * @param HttpHeadersInterface $headers
     * @return $this
     */
    public function setHeaders(HttpHeadersInterface $headers)
    {
        $this->headers = $headers;
        return $this;
    }
}
