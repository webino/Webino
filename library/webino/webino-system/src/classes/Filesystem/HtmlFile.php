<?php

namespace Webino\Filesystem;

/**
 * Class HtmlFile
 * @package webino-system
 */
final class HtmlFile extends AbstractFile
{
    /**
     * @param string $path
     * @param mixed ...$parameter
     */
    function __construct(string $path, ...$parameter)
    {
        parent::__construct("system://html/{$path}.html", ...$parameter);
    }
}
