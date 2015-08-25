<?php

namespace WebinoConfigLib\Feature;

use WebinoConfigLib\Log\Writer;

/**
 * Class ChromePhpLog
 */
class ChromePhpLog extends AbstractLog
{
    /**
     * Create a FirePhp log writer
     */
    public function __construct()
    {
        $this->writer = new Writer\ChromePhp;
    }
}
