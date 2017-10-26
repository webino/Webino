<?php

namespace WebinoHtmlLib\Html;

/**
 * Class Url
 */
final class Url extends Tag
{
    /**
     * @param string $href
     * @param string|array $text
     * @param bool $escape
     */
    public function __construct($href, $text, $escape = true)
    {
        parent::__construct('a', $text, $escape);
        $this->setAttribute('href', $href);
    }
}
