<?php

namespace WebinoHtmlLib\Html;

/**
 * Class Strong
 */
final class Strong extends Tag
{
    /**
     * @param string|array $text
     * @param bool $escape
     */
    public function __construct($text, $escape = true)
    {
        parent::__construct('strong', $text, $escape);
    }
}
