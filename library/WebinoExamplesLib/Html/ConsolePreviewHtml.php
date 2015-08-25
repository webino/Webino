<?php

namespace WebinoExamplesLib\Html;

use WebinoExamplesLib\Html\ScrollBoxHtml as BaseScrollBoxHtml;
use WebinoHtmlLib\ImgHtml;

/**
 * Class ConsolePreviewHtml
 */
final class ConsolePreviewHtml extends BaseScrollBoxHtml
{
    /**
     * @param string $imgSrc Console preview image src
     */
    public function __construct($imgSrc)
    {
        parent::__construct(new ImgHtml($imgSrc));

        $this->setStyle([
            'height'     => '400px',
            'overflow-x' => 'hidden',
            'padding'    => '0',
            'background' => '#300a24',
        ]);
    }
}
