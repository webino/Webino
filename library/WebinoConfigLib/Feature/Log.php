<?php

namespace WebinoConfigLib\Feature;

use WebinoConfigLib\Log\Writer;

/**
 * Class Log
 */
class Log extends AbstractLog
{
    /**
     * @param string $filePath
     */
    public function __construct($filePath)
    {
        $this->mergeArray([
            $this::KEY => (new Writer([
                (new Writer\Stream($filePath))->toArray(),
            ]))->toArray(),
        ]);
    }
}
