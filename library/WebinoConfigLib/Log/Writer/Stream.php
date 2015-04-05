<?php

namespace WebinoConfigLib\Log\Writer;

use WebinoConfigLib\Log\Writer as BaseWriter;

/**
 * Class Stream
 */
class Stream extends BaseWriter
{
    /**
     * Create a stream log writer
     *
     * @param string $stream Url or file path
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
