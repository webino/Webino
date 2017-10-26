<?php

namespace WebinoHtmlLib\Html;

/**
 * Class Block
 */
final class Block extends Tag
{
    /**
     * @param string|array $text
     * @param bool $escape
     */
    public function __construct($text, $escape = false)
    {
        parent::__construct('div', $text, $escape);
    }
}
