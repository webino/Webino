<?php

namespace WebinoAppLib\Response;

/**
 * Class TextResponse
 */
class TextResponse extends AbstractHttpResponse
{
    /**
     * @param string $text
     */
    public function __construct($text)
    {
        $this->setContent($text);
        $this->setContentType('text/plain');
    }
}
