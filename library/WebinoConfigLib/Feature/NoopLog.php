<?php

namespace WebinoConfigLib\Feature;

use WebinoConfigLib\Log\Writer;

/**
 * Class NoopLog
 */
class NoopLog extends AbstractLog
{
    /**
     * Configure the null cache
     */
    public function __construct()
    {
        $this->mergeArray([
            $this::KEY => (new Writer([
                (new Writer\Noop)->toArray(),
            ]))->toArray(),
        ]);
    }
}
