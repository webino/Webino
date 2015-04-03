<?php

namespace WebinoConfigLib\Log\Writer;

use WebinoConfigLib\Log\Writer as BaseWriter;

/**
 * Class Stream
 */
class Stream extends BaseWriter
{
    /**
     * @param string $stream Url or filepath
     * @param string|null $mode File mode
     * @param string|null $separator Log message separator
     */
    public function __construct($stream, $mode = null, $separator = null)
    {
        $this->mergeArray([
            'name' => 'stream',
            'priority' => null,
            'options' => [
                'stream' => $stream,
                'mode' => $mode,
                'logSeparator' => $separator,
            ],
        ]);
    }
}
