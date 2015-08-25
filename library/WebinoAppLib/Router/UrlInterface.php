<?php

namespace WebinoAppLib\Router;

use WebinoHtmlLib\UrlHtmlInterface;

/**
 * Interface UrlInterface
 */
interface UrlInterface
{
    /**
     * @param string $label
     * @return UrlHtmlInterface
     */
    public function html($label = '');
}
