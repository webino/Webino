<?php

namespace Webino;

/**
 * Interface FormFieldInterface
 * @package webino-form
 */
interface FormFieldInterface
{
    /**
     * Return form input name
     *
     * @return string
     */
    function getName(): string;

    /**
     * Returns form input data
     *
     * @return string
     */
    function getData(): string;

    /**
     * Sets form input data
     *
     * @param string $data
     */
    function setData(string $data): void;

    /**
     * Returns true when form is valid
     *
     * @return bool
     */
    function isValid(): bool;
}
