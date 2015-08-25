<?php

namespace WebinoAppLib\Response;

/**
 * Class HtmlResponse
 */
class HtmlResponse extends AbstractHttpResponse
{
    /**
     * @param string $html
     */
    public function __construct($html = null)
    {
        $html and $this->setContent($html);
        $this->setContentType('text/html');
    }
}
