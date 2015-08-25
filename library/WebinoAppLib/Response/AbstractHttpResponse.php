<?php

namespace WebinoAppLib\Response;

use Zend\Http\PhpEnvironment\Response;

/**
 * Class AbstractHttpResponse
 */
abstract class AbstractHttpResponse extends Response
{
    /**
     * @param string $contentType
     * @return $this
     */
    protected function setContentType($contentType)
    {
        $this->getHeaders()->addHeaderLine('Content-type', $contentType);
        return $this;
    }
}
