<?php

namespace WebinoHtmlLib;

/**
 * Class UrlHtml
 */
final class UrlHtml extends AbstractHtml
{
    /**
     * @param string $href
     * @param string $label
     */
    public function __construct($href, $label)
    {
        $this->setAttribute('href', $href);
        $this->setValue($label);
    }

    /**
     * @return string
     */
    protected function getTagName()
    {
        return 'a';
    }
}
