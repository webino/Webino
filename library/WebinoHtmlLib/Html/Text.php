<?php

namespace WebinoHtmlLib\Html;

/**
 * Class Text
 */
final class Text extends Tag
{
    /**
     * @param string|array $text
     * @param bool $escape
     */
    public function __construct($text, $escape = true)
    {
        parent::__construct('p', $text, $escape);
    }
}
