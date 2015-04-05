<?php

namespace WebinoConfigLib\Log\Writer;

use WebinoConfigLib\AbstractConfig;

/**
 * Class FirePhp
 */
class FirePhp extends AbstractConfig
{
    /**
     * Create a FirePhp log writer
     */
    public function __construct()
    {
        $this->mergeArray(['name' => 'firephp']);
    }
}
