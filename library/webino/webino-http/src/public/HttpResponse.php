<?php

namespace Webino;

use Webino\HttpHeader\ContentType;

/**
 * Class HttpResponse
 * @package webino-http
 */
class HttpResponse extends AbstractHttpMessage implements
    HttpResponseInterface
{
    /**
     * @var ContentType
     */
    protected $contentType;

    /**
     * {@inheritdoc}
     */
    function getContentType(): ContentType
    {
        if (!$this->contentType) {
            $this->setContentType('text/plain');
        }
        return $this->contentType;
    }

    /**
     * {@inheritdoc}
     */
    function setContentType($type)
    {
        $this->contentType = $type instanceof ContentType ? $type : new ContentType($type);
        return $this;
    }
}
