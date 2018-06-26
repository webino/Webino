<?php

namespace Webino\Response;

/**
 * Class HtmlResponse
 */
class HtmlResponse extends TextResponse
{
    /**
     * {@inheritdoc}
     */
    public function __construct(string $content)
    {
        parent::__construct($content);
        $this->setContentType('text/html');
    }
}
