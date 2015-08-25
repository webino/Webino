<?php

namespace WebinoHtmlLib;

/**
 * Interface UrlHtmlInterface
 */
interface UrlHtmlInterface
{
    /**
     * @param string $title
     * @return self
     */
    public function setTitle($title);

    /**
     * @param string $class
     * @return self
     */
    public function setClass($class);
}
