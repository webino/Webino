<?php

namespace WebinoExamplesLib\Html;

use WebinoHtmlLib\ScrollBoxHtml as BaseScrollBoxHtml;

/**
 * Class ScrollBoxHtml
 */
class ScrollBoxHtml extends BaseScrollBoxHtml
{
    /**
     * @param string $text
     * @param bool $escape
     */
    public function __construct($text, $escape = false)
    {
        parent::__construct($text, $escape);

        $this->setStyle([
            'height' => '200px',
            'padding' => '0 8px',
            'border' => '1px solid lightgray',
            'border-right' => '0',
        ]);
    }
}
