<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

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
