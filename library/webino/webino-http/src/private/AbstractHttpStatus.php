<?php

namespace Webino;

/**
 * Class AbstractHttpStatus
 * @package webino-http
 */
abstract class AbstractHttpStatus implements HttpStatusInterface
{
    /**
     * {@inheritdoc}
     */
    abstract function getCode(): int;

    /**
     * {@inheritdoc}
     */
    abstract function getPhrase(): string;

    /**
     * {@inheritdoc}
     */
    abstract function getVersion(): string;

    /**
     * {@inheritdoc}
     */
    function send(): void
    {
        http_response_code($this->getCode());
    }

    /**
     * @return string
     */
    function __toString()
    {
        return trim(
            sprintf(
                'HTTP/%s %d %s',
                $this->getVersion(),
                $this->getCode(),
                $this->getPhrase()
            )
        );
    }
}
