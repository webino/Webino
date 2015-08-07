<?php

namespace WebinoAppLib\Router;

use WebinoBaseLib\Html\UrlHtmlInterface;

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
