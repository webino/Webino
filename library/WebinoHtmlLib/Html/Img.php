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
 * Class Img
 */
class Img extends AbstractHtml
{
    /**
     * @param string $src
     */
    public function __construct($src)
    {
        $this->setAttribute('src', $src);
    }

    /**
     * @return string
     */
    protected function getTagName()
    {
        return 'img';
    }
}
