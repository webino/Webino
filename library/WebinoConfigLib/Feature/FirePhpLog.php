<?php

namespace WebinoConfigLib\Feature;

use WebinoConfigLib\Log\Writer;

/**
 * Class FirePhpLog
 */
class FirePhpLog extends AbstractLog
{
    /**
     * Create a FirePhp log writer
     */
    public function __construct()
    {
        $this->writer = new Writer\FirePhp;
    }
}
