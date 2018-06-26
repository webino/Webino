<?php

namespace Webino;

/**
 * Class AbstractHttpStatus
 */
abstract class AbstractHttpStatus implements HttpStatusInterface
{
    /**
     * {@inheritdoc}
     */
    abstract public function getCode() : int;

    /**
     * {@inheritdoc}
     */
    abstract public function getPhrase() : string;

    /**
     * {@inheritdoc}
     */
    abstract public function getVersion() : string;

    /**
     * {@inheritdoc}
     */
    public function send() : void
    {
        http_response_code($this->getCode());
    }

    /**
     * @return string
     */
    public function __toString()
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
