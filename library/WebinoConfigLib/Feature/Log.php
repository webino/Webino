<?php

namespace WebinoConfigLib\Feature;

use WebinoConfigLib\Log\Writer;

/**
 * Class Log
 */
class Log extends AbstractLog
{
    /**
     * Default log file path
     */
    const DEFAULT_FILE_PATH = 'data/log/app.log';

    /**
     * @param string $filePath
     */
    public function __construct($filePath = null)
    {
        $this->mergeArray([
            $this::KEY => (new Writer([
                (new Writer\Stream((null === $filePath) ? self::DEFAULT_FILE_PATH : $filePath))->toArray(),
            ]))->toArray(),
        ]);
    }
}
