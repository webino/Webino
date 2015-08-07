<?php

namespace WebinoBaseLib\Html;

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
        $this->addAttribute('href', $href);
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
