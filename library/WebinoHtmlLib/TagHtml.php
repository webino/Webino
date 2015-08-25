<?php

namespace WebinoHtmlLib;

/**
 * Class TagHtml
 */
final class TagHtml extends AbstractHtml
{
    /**
     * @var string
     */
    private $tagName;

    /**
     * @param string $tagName
     * @param string $text
     * @param bool $escape
     */
    public function __construct($tagName, $text, $escape = false)
    {
        $this->tagName = $tagName;
        $this->setValue($text);
        $this->setEscape($escape);
    }

    /**
     * @return string
     */
    protected function getTagName()
    {
        return $this->tagName;
    }
}
