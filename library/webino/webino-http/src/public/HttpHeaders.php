<?php

namespace Webino;

/**
 * Class HttpHeaders
 * @package webino-http
 */
class HttpHeaders implements HttpHeadersInterface
{
    /**
     * @var HttpHeaderInterface[]
     */
    protected $headers = [];

    /**
     * {@inheritdoc}
     */
    function set(HttpHeaderInterface $header)
    {
        $this->headers[$header->getName()] = $header;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    function send()
    {
        foreach ($this->headers as $header) {
            $header->send();
        }
    }
}
