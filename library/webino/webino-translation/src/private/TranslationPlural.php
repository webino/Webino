<?php

namespace Webino;

/**
 * Class TranslationPlural
 * @package webino-translation
 */
final class TranslationPlural
{
    /**
     * Pluralize translation term
     *
     * @param TranslationInterface $translation
     * @param string $term
     * @return string
     */
    function __invoke(TranslationInterface $translation, string $term): string
    {
        if (false !== strpos($term, ':')) {
            $parts = explode(':', $term);
            if ($parts[1] ?? false) {
                $pattern = $translation[$parts[0]];
                array_shift($parts);
                return \MessageFormatter::formatMessage(\Locale::getDefault(), $pattern, $parts);
            }
        }

        return $term;
    }
}
