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
 * Interface UrlInterface
 */
interface UrlInterface
{
    /**
     * @param string $title
     * @return $this
     */
    public function setTitle($title);

    /**
     * @param string $class
     * @return $this
     */
    public function setClass($class);
}
