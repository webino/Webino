<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoHtmlLib\Html;

/**
 * Class Title
 */
class Title extends Tag
{
    /**
     * @param string|array|HtmlInterface $text
     */
    public function __construct($text)
    {
        parent::__construct('h1', $text);
    }
}
