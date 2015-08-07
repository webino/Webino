<?php

namespace WebinoBaseLib\Html;

/**
 * Class TextHtml
 */
final class TextHtml extends AbstractHtml
{
    /**
     * @param string $text
     * @param bool $escape
     */
    public function __construct($text, $escape = true)
    {
        $this->setValue($text);
        $this->setEscape($escape);
    }

    /**
     * @return string
     */
    protected function getTagName()
    {
        return 'p';
    }
}
