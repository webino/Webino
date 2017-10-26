<?php

namespace WebinoHtmlLib\Html;

/**
 * Interface UrlInterface
 */
interface UrlInterface
{
    /**
     * @param string $title
     * @return $this
     */
    public function setTitle($title);

    /**
     * @param string $class
     * @return $this
     */
    public function setClass($class);
}
