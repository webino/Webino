<?php

namespace WebinoHtmlLib;

/**
 * Class ScrollBoxHtml
 */
class ScrollBoxHtml extends AbstractHtml
{
    /**
     * @param string $text
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
}
