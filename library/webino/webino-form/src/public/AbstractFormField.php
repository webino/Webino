<?php

namespace Webino;

/**
 * Class AbstractFormInput
 * @package webino-form
 */
abstract class AbstractFormField implements FormFieldInterface, HtmlPartInterface
{
    use FormFieldTrait;
    use FormInputTrait;
    use FormValueInputTrait;
    use FormWithStyleTrait;

    /**
     * @param string $name
     * @param iterable $options
     */
    function __construct(string $name, iterable $options = [])
    {
        $this->name = $name;
        $this->setOptions($options);
    }
}
