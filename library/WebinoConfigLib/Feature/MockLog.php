<?php

namespace WebinoConfigLib\Feature;

use WebinoConfigLib\Log\Writer;

/**
 * Class MockLog
 */
class MockLog extends AbstractLog
{
    /**
     * Create a Mock log writer
     */
    public function __construct()
    {
        $this->writer = new Writer\Mock;
    }
}
