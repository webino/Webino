<?php

namespace Webino;

/**
 * Class Translator
 * @package webino-translation
 */
class Translator implements TranslatorInterface
{
    /**
     * @var TranslationInterface[]
     */
    private $translations;

    /**
     * @var callable[]
     */
    private $lazyTranslations;

    /**
     * @param string $locale
     * @return TranslationInterface
     */
    function getTranslation(string $locale): TranslationInterface
    {
        if (empty($this->translations[$locale])) {
            //TODO  throw exception
        }

        foreach ($this->lazyTranslations[$locale] as $lazyTranslation) {
            $this->addTranslation($locale, $lazyTranslation());
        }

        return $this->translations[$locale];
    }

    /**
     * Set translation for locale
     *
     * @param string $locale
     * @param TranslationInterface $translation
     */
    function addTranslation(string $locale, TranslationInterface $translation): void
    {
        if (isset($this->translations[$locale])) {
            $this->translations[$locale]->merge($translation);
        } else {
            $this->translations[$locale] = $translation;
        }
    }

    /**
     * Set lazy translation callback for locale
     *
     * @param string $locale
     * @param callable $callback
     */
    function addLazyTranslation(string $locale, callable $callback): void
    {
        $this->lazyTranslations[$locale][] = $callback;
    }
}
