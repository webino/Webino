<?php

namespace WebinoBaseLib\Html;

/**
 * Class ScrollBoxHtml
 */
final class ScrollBoxHtml extends AbstractHtml
{
    /**
     * @param string $text
     * @param bool $escape
     */
    public function __construct($text, $escape = true)
    {
        $this->setValue($text);
        $this->setEscape($escape);
        $this->setStyle([
            'height' => '200px',
            'overflow' => 'auto',
            'padding' => '0 8px',
            'border' => '1px solid lightgray',
            'border-right' => '0',
        ]);
    }

    /**
     * @return string
     */
    protected function getTagName()
    {
        return 'div';
    }
}
