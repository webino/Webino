<?php

namespace Webino;

/**
 * Interface TranslatorInterface
 * @package webino-translate
 */
interface TranslatorInterface
{
    /**
     * @param string $locale
     * @return TranslationInterface
     */
    function getTranslation(string $locale): TranslationInterface;
}
