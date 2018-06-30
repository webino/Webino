<?php

namespace Webino;

use Webino\HttpHeader\ContentType;

/**
 * Class HttpResponse
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
    public function getContentType(): ContentType
    {
        if (!$this->contentType) {
            $this->setContentType('text/plain');
        }
        return $this->contentType;
    }

    /**
     * {@inheritdoc}
     */
    public function setContentType($type)
    {
        $this->contentType = $type instanceof ContentType ? $type : new ContentType($type);
        return $this;
    }
}
