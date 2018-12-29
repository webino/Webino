<?php

namespace Webino;

/**
 * Interface TranslationInterface
 * @package webino-translation
 */
interface TranslationInterface extends \ArrayAccess, \IteratorAggregate
{
    /**
     * Translate text
     *
     * @param string $text
     * @return string
     */
    function translate(string $text): string;

    /**
     * Merge into translation
     *
     * @param iterable $translation
     */
    function merge(iterable $translation): void;
}
