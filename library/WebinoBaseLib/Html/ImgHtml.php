<?php

namespace WebinoBaseLib\Html;

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
        $this->addAttribute('src', $src);
    }

    /**
     * @return string
     */
    protected function getTagName()
    {
        return 'img';
    }
}
