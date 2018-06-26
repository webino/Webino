<?php

namespace Webino\Event;

use Webino\HttpHeaders;
use Webino\HttpHeadersInterface;
use Webino\HttpStatus;
use Webino\HttpStatusInterface;

/**
 * Class HttpResponseEvent
 */
class HttpResponseEvent extends ResponseEvent
{
    /**
     * @var HttpStatusInterface
     */
    protected $status;

    /**
     * @var HttpHeadersInterface
     */
    protected $headers;

    /**
     * Return HTTP status code
     *
     * @return HttpStatusInterface
     */
    public function getStatus() : HttpStatusInterface
    {
        if (!$this->status) {
            $this->setStatus(new HttpStatus\Ok);
        }
        return $this->status;
    }

    /**
     * Set HTTP status code
     *
     * @param HttpStatusInterface $status
     * @return $this
     */
    public function setStatus(HttpStatusInterface $status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return HttpHeadersInterface
     */
    public function getHeaders(): HttpHeadersInterface
    {
        if (!$this->headers) {
            $this->setHeaders(new HttpHeaders);
        }
        return $this->headers;
    }

    /**
     * @param HttpHeadersInterface $headers
     * @return $this
     */
    public function setHeaders(HttpHeadersInterface $headers)
    {
        $this->headers = $headers;
        return $this;
    }
}
