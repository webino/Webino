<?php

namespace Webino;

/**
 * Class AbstractTranslation
 * @package webino-translation
 */
class Translation implements TranslationInterface
{
    /**
     * Text translation macro pattern
     */
    const MACRO_PATTERN = '~t\[([^\]]++)\]~';

    /**
     * Translation lexicon
     *
     * @var iterable
     */
    protected $translation = [];

    /**
     * Translation callbacks
     *
     * @var iterable
     */
    private $callbacks = [];

    /**
     * @param CreateInstanceEventInterface $event
     * @return Translation
     */
    static function create(CreateInstanceEventInterface $event): Translation
    {
        $container = $event->getContainer();
        $params = $event->getParameters();
        $params[] = [$container->get(TranslationPlural::class)];
        return new static(...$params);
    }

    /**
     * @param iterable $translation
     * @param iterable|callable[] $callbacks
     */
    function __construct(iterable $translation, iterable $callbacks = [])
    {
        $this->translation = $translation;
        $this->callbacks = $callbacks;
    }

    /**
     * @return iterable
     */
    function getIterator(): iterable
    {
        return new \ArrayIterator($this->translation);
    }

    /**
     * Translate text
     *
     * @param string $text
     * @return string
     */
    function translate(string $text): string
    {
        $newText = preg_replace_callback($this::MACRO_PATTERN, function (array $match) {
            if (empty($match[1])) {
                return $match[0] ?? '';
            }

            foreach ($this->callbacks as $callback) {
                $match[1] = $callback($this, $match[1]);
            }

            return $this[$match[1]] ?: $match[1];
        }, $text);

        return $newText;
    }

    /**
     * Merge into translation
     *
     * @param iterable $translation
     */
    function merge(iterable $translation): void
    {
        foreach ($translation as $index => $value) {
            $this->translation[$index] = $value;
        }
    }

    /**
     * @param string $offset
     * @return bool
     */
    function offsetExists($offset)
    {
        return isset($this->translation[(string) $offset]);
    }

    /**
     * @param string $offset
     * @return mixed|string
     */
    function offsetGet($offset)
    {
        return $this->translation[(string) $offset] ?? $offset;
    }

    /**
     * @param string $offset
     * @param mixed $value
     */
    function offsetSet($offset, $value)
    {
        $this->translation[(string) $offset] = $value;
    }

    /**
     * @param mixed $offset
     */
    function offsetUnset($offset)
    {
        if ($this->offsetExists($offset)) {
            unset($this->translation[(string) $offset]);
        }
    }
}
