<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoHtmlLib\Html;

/**
 * Class Url
 */
class Url extends Tag
{
    /**
     * @param string $href
     * @param string|array|HtmlInterface $text
     */
    public function __construct($href, $text = null)
    {
        parent::__construct('a', $text ?: $href);
        $this->setAttribute('href', $href);
    }
}
