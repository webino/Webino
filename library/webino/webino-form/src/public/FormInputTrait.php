<?php

namespace Webino;

/**
 * Trait FormInputTrait
 * @package webino-form
 */
trait FormInputTrait
{
    /**
     * Input name
     *
     * @var string
     */
    private $name;

    /**
     * @param string $name
     */
    function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * Return form input name
     *
     * @return string
     */
    function getName(): string
    {
        return (string) $this->name;
    }
}
