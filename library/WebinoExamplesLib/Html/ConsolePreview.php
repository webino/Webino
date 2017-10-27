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
 * Class ConsolePreview
 */
final class ConsolePreview extends Html\Block
{
    use Html\HeightStyleTrait;

    /**
     * @param string $imgSrc Console preview image src
     * @param string $label Console preview label
     */
    public function __construct($imgSrc, $label = 'Console Preview')
    {
        $label = (new Html\Text($label))
            ->setStyle([
                'position' => 'absolute',
                'left' => '1px',
                'top' => '1px',
                'margin' => 0 ,
                'padding' => '8px',
                'background' => 'white',
            ]);

        parent::__construct($label . new Html\Img($imgSrc));

        $this->setStyle([
            'position'   => 'relative',
            'overflow-x' => 'hidden',
            'padding'    => '48px 0 0',
            'background' => '#300a24',
        ]);
    }
}
