<?php

namespace Webino;

/**
 * Class HttpHeaders
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
    public function set(HttpHeaderInterface $header)
    {
        $this->headers[$header->getName()] = $header;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function send()
    {
        foreach ($this->headers as $header) {
            $header->send();
        }
    }
}
