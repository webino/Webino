<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Response\Content;

/**
 * Class SourcePreview
 */
class SourcePreview
{
    /**
     * @var string
     */
    private $path;

    /**
     * SourcePreview constructor.
     *
     * @param string $path
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf(
            file_get_contents(__DIR__ . '/resources/source-preview.html'),
            highlight_file($this->path, true)
        );
    }
}
