<?php

namespace WebinoHtmlLib\Html;

/**
 * Class Tag
 */
class Tag extends AbstractHtml
{
    /**
     * @var string
     */
    private $tagName;

    /**
     * @param string $tagName
     * @param string|array $text
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
