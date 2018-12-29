<?php

namespace Webino\Filesystem;

/**
 * Class LocalFile
 * @package webino-filesystem
 */
class LocalFile extends AbstractFilesystemFile
{
    use LocalNodeTrait;

    /**
     * Returns file contents
     *
     * @return string
     */
    function getContents(): string
    {
        return file_get_contents($this->getPath());
    }

    /**
     * Sets file contents
     *
     * @param string $fileContents
     */
    function setContents(string $fileContents): void
    {
        file_put_contents($this->getPath(), $fileContents);
    }

    /**
     * Returns file integrity hash
     *
     * @see https://www.w3.org/TR/SRI/
     * @return string
     */
    function getIntegrity(): string
    {
        $algo = 'sha384';
        $hash = base64_encode(hash_file($algo, $this->getRealPath(), true));
        return "{$algo}-{$hash}";
    }
}
