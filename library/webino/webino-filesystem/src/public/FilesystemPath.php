<?php

namespace Webino;

/**
 * Class FilesystemPath
 * @package webino-filesystem
 */
final class FilesystemPath
{
    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $scheme;

    /**
     * @var string
     */
    private $pathName;

    /**
     * @param string $path
     */
    function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * @return void
     */
    private function setupPath(): void
    {
        $parts = explode('://', $this->path, 2);

        if (!empty($parts[1])) {
            $this->scheme = $parts[0];
            $this->pathName = $parts[1];

        } elseif (!empty($parts[0])) {
            $this->pathName = $parts[0];
        }
    }

    /**
     * Returns filesystem file path
     *
     * @return string
     */
    function getPath(): string
    {
        return $this->path;
    }

    /**
     * Return filesystem file path scheme
     *
     * @param string|null $default
     * @return string
     */
    function getScheme(string $default = null): string
    {
        $this->scheme or $this->setupPath();
        return (string) ($this->scheme ?? $default);
    }

    /**
     * Returns filesystem file path name
     *
     * @return string File path without scheme
     */
    function getPathName(): string
    {
        $this->pathName or $this->setupPath();
        return (string) $this->pathName;
    }
}
