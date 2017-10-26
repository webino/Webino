<?php

namespace WebinoHtmlLib\Html;

/**
 * Class Img
 */
final class Img extends AbstractHtml
{
    /**
     * @param string $src
     */
    public function __construct($src)
    {
        $this->setAttribute('src', $src);
    }

    /**
     * @return string
     */
    protected function getTagName()
    {
        return 'img';
    }
}
