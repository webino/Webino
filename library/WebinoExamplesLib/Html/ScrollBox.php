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
 * Class ScrollBox
 */
class ScrollBox extends Html\ScrollBox
{
    /**
     * @param string $text
     */
    public function __construct($text)
    {
        parent::__construct(new Html\Html(nl2br($text)));

        $this->setStyle([
            'height' => '200px',
            'padding' => '0 8px',
            'border' => '1px solid lightgray',
            'border-right' => '0',
        ]);
    }
}
