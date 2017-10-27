<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoExamplesLib\Html;

use WebinoHtmlLib\Html;

/**
 * Class FieldSetScrollBox
 */
class FieldSetScrollBox extends Html\FieldSet
{
    /**
     * @param string $legend
     * @param array|string $value
     */
    public function __construct($legend, $value)
    {
        parent::__construct($legend, (new ScrollBox($value))->setStyle('border', null));
        $this->setStyle('margin-bottom', '10px');
    }
}
