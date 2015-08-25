<?php

namespace WebinoConfigLib\Log\Writer;

/**
 * Class FirePhp
 */
class FirePhp extends AbstractWriter
{
    /**
     * Create a FirePhp log writer
     */
    public function __construct()
    {
        $this->mergeArray(['name' => 'firephp']);
    }
}
