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
 * Trait HeightStyleTrait
 */
trait HeightStyleTrait
{
    /**
     * Set height style
     *
     * @param int $height Height in pixels
     * @param string $units
     * @return $this
     */
    public function setHeight($height, $units = 'px')
    {
        $this->setStyle(['height' => $height . $units]);
        return $this;
    }
}
