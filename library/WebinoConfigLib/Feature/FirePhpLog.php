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
        $this->mergeArray([
            $this::KEY => (new Writer([
                (new Writer\FirePhp)->toArray(),
            ]))->toArray(),
        ]);
    }
}
