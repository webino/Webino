<?php

namespace Webino;

/**
 * Class HtmlResponse
 * @package webino-responder
 */
class HtmlResponse extends TextResponse
{
    /**
     * {@inheritdoc}
     */
    function __construct(string $content)
    {
        parent::__construct($content);
        $this->setContentType('text/html');
    }
}
