<?php

namespace Webino\HttpStatus;

/**
 * Trait HttpStatusV11Trait
 */
trait V11Trait
{
    /**
     * {@inheritdoc}
     */
    public function getVersion() : string
    {
        return '1.1';
    }
}
