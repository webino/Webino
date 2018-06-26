<?php

namespace Webino\Response;

use Webino\HttpResponse;

/**
 * Class TextResponse
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
    public function __construct(string $content)
    {
        $this->setContent($content);
    }

    /**
     * @return string
     */
    public function getContent() : string
    {
        return $this->content;
    }

    /**
     * Set HTML response content
     *
     * @param string $content
     * @return $this
     */
    public function setContent(string $content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getContent();
    }
}
