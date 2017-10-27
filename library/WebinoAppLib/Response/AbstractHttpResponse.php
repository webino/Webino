<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

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
