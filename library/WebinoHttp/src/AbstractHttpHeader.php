<?php

namespace Webino;

/**
 * Class AbstractHttpHeader
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
    abstract public function getName(): string;

    /**
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * {@inheritdoc}
     */
    public function send()
    {
        header((string) $this);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf('%s: %s', $this->getName(), $this->getValue());
    }
}
