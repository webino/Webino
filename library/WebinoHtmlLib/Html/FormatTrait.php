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
 * Trait FormatTrait
 */
trait FormatTrait
{
    /**
     * @var array
     */
    private $format = [];

    /**
     * Set format values
     *
     * @param array $format
     * @return $this
     */
    public function format(array $format)
    {
        $this->format = array_merge($this->format, $format);
        return $this;
    }

    /**
     * @param string $str
     * @return string
     */
    protected function doFormat($str)
    {
        return strtr($str, $this->format);
    }
}
