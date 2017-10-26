<?php

namespace WebinoHtmlLib\Html;

/**
 * Class ScrollBox
 */
class ScrollBox extends AbstractHtml
{
    /**
     * @param string|array $text
     * @param bool $escape
     */
    public function __construct($text, $escape = false)
    {
        $this->setValue($text);
        $this->setEscape($escape);
        $this->setStyle(['overflow' => 'auto']);
    }

    /**
     * @return string
     */
    protected function getTagName()
    {
        return 'div';
    }

    /**
     * @param int $height Height in pixels
     * @return $this
     */
    public function setHeight($height)
    {
        $this->setStyle(['height' => $height . 'px']);
        return $this;
    }
}
