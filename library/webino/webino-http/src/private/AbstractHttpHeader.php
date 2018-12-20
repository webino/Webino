<?php

namespace Webino;

/**
 * Class AbstractHttpHeader
 * @package webino-http
 */
abstract class AbstractHttpHeader implements HttpHeaderInterface
{
    /**
     * Header value
     *
     * @var string
     */
    protected $value;

    /**
     * {@inheritdoc}
     */
    abstract function getName(): string;

    /**
     * @param string $value
     */
    function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * {@inheritdoc}
     */
    function getValue(): string
    {
        return $this->value;
    }

    /**
     * {@inheritdoc}
     */
    function send()
    {
        header((string) $this);
    }

    /**
     * @return string
     */
    function __toString()
    {
        return sprintf('%s: %s', $this->getName(), $this->getValue());
    }
}
