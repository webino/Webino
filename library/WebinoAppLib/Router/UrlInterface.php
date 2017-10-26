<?php

namespace WebinoAppLib\Router;

use WebinoHtmlLib\Html;

/**
 * Interface UrlInterface
 */
interface UrlInterface
{
    /**
     * @param string $label
     * @return Html\UrlInterface
     */
    public function html($label = '');
}
