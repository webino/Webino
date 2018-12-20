<?php

namespace Webino;

/**
 * Class TextResponse
 * @package webino-responder
 */
class TextResponse extends HttpResponse
{
    /**
     * @var string
     */
    protected $content;

    /**
     * @param string $content HTML content
     */
    function __construct(string $content)
    {
        $this->setContent($content);
    }

    /**
     * @return string
     */
    function getContent(): string
    {
        return $this->content;
    }

    /**
     * Set HTML response content
     *
     * @param string $content
     * @return $this
     */
    function setContent(string $content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return string
     */
    function __toString()
    {
        return $this->getContent();
    }
}
