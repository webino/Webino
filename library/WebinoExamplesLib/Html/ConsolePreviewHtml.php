<?php

namespace WebinoExamplesLib\Html;

use WebinoExamplesLib\Html\ScrollBoxHtml as BaseScrollBoxHtml;
use WebinoHtmlLib\ImgHtml;
use WebinoHtmlLib\TextHtml;

/**
 * Class ConsolePreviewHtml
 */
final class ConsolePreviewHtml extends BaseScrollBoxHtml
{
    /**
     * @var string
     */
    private $label;

    /**
     * @param string $imgSrc Console preview image src
     * @param string $label Console preview label
     */
    public function __construct($imgSrc, $label = 'Console preview:')
    {
        parent::__construct(new ImgHtml($imgSrc));
        $this->label = $label;

        $this->setStyle([
            'overflow-x' => 'hidden',
            'padding'    => '0',
            'background' => '#300a24',
        ]);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (new TextHtml($this->label)) . parent::__toString();
    }
}
