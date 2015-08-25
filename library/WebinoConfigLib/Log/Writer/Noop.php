<?php

namespace WebinoConfigLib\Log\Writer;

/**
 * Class Noop
 */
class Noop extends AbstractWriter
{
    /**
     * Create a black hole log writer
     */
    public function __construct()
    {
        $this->mergeArray(['name' => 'noop']);
    }
}
