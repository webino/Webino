<?php

namespace WebinoHtmlLib;

/**
 * Class ImgHtml
 */
final class ImgHtml extends AbstractHtml
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
