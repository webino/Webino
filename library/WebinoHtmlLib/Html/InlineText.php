<?php

namespace WebinoHtmlLib\Html;

/**
 * Class InlineText
 */
final class InlineText extends Tag
{
    /**
     * @param string|array $text
     * @param bool $escape
     */
    public function __construct($text, $escape = true)
    {
        parent::__construct('span', $text, $escape);
    }
}
