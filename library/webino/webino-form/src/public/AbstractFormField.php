<?php

namespace Webino;

/**
 * Class AbstractFormInput
 * @package webino-form
 */
abstract class AbstractFormField implements FormFieldInterface, HtmlPartInterface
{
    use FormInputTrait;
    use FormValueInputTrait;
}
