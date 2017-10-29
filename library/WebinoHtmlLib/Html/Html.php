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
 * Class Html
 */
class Html implements HtmlInterface
{
    use FormatTrait;

    /**
     * @var string
     */
    protected $html;

    /**
     * @param string|array|HtmlInterface $html
     */
    public function __construct($html)
    {
        $this->html = (string) $html;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->doFormat($this->html);
    }
}
