<?php

namespace Webino;

/**
 * Class Filesystem
 * @package webino-filesystem
 */
class Filesystem
{
    /**
     * Default file scheme
     *
     * @var string
     */
    private $defaultFileScheme = 'local';

    /**
     * Filesystem scheme aliases
     *
     * @var array
     */
    private $schemeAliases = [];

    /**
     * Get default file scheme
     *
     * @return string
     */
    function getDefaultFileScheme(): string
    {
        return $this->defaultFileScheme;
    }

    /**
     * Set default file scheme
     *
     * @param string $defaultFileScheme
     */
    function setDefaultFileScheme(string $defaultFileScheme): void
    {
        // TODO exception on empty
        $this->defaultFileScheme = $defaultFileScheme;
    }

    /**
     * Get filesystem scheme aliases
     *
     * @return iterable
     */
    function getFileSchemeAliases(): iterable
    {
        return $this->schemeAliases;
    }

    /**
     * Set filesystem scheme alias
     *
     * @param string $scheme Filesystem scheme
     * @param string $alias Scheme alias
     */
    function setFileSchemeAlias(string $scheme, string $alias): void
    {
        $this->schemeAliases[$alias] = $scheme;
    }
}
