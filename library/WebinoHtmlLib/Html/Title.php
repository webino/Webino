<?php

namespace WebinoHtmlLib\Html;

/**
 * Class Title
 */
class Title extends Tag
{
    /**
     * @param string|array $text
     * @param bool $escape
     */
    public function __construct($text, $escape = true)
    {
        parent::__construct('h1', $text, $escape);
    }
}
