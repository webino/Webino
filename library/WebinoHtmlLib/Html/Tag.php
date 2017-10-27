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
 * Class Tag
 */
class Tag extends AbstractHtml
{
    /**
     * @var string
     */
    private $tagName;

    /**
     * @param string $tagName
     * @param string|array|HtmlInterface $text
     */
    public function __construct($tagName, $text)
    {
        $this->tagName = $tagName;
        $this->setValue($text);
    }

    /**
     * @return string
     */
    protected function getTagName()
    {
        return $this->tagName;
    }
}
