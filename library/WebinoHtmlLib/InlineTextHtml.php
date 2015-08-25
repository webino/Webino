<?php

namespace WebinoHtmlLib;

/**
 * Class InlineTextHtml
 */
final class InlineTextHtml extends AbstractHtml
{
    /**
     * @param string $text
     */
    public function __construct($text)
    {
        $this->setValue($text);
    }

    /**
     * @return string
     */
    protected function getTagName()
    {
        return 'span';
    }
}
