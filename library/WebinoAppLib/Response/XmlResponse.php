<?php

namespace WebinoAppLib\Response;

/**
 * Class XmlResponse
 */
class XmlResponse extends AbstractHttpResponse
{
    /**
     * @param string $xml
     */
    public function __construct($xml)
    {
        $this->setContent($xml);
        $this->setContentType('text/xml');
    }
}
