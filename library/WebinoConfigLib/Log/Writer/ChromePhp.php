<?php

namespace WebinoConfigLib\Log\Writer;

/**
 * Class ChromePhp
 */
class ChromePhp extends AbstractWriter
{
    /**
     * Create a FirePhp log writer
     */
    public function __construct()
    {
        $this->mergeArray(['name' => 'chromephp']);
    }
}
