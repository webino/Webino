<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoConfigLib\Log\Writer;

/**
 * Class Stream
 */
class Stream extends AbstractWriter
{
    /**
     * Create a stream log writer
     *
     * @param string $stream Url or file path
     * @param string|null $mode File mode
     * @param string|null $separator Log message separator
     */
    public function __construct($stream = null, $mode = null, $separator = null)
    {
        $options = [];

        $stream and $options['stream']       = $stream;
        $mode   and $options['mode']         = $mode;
        $mode   and $options['logSeparator'] = $separator;

        $this->mergeArray([
            'name'     => 'stream',
            'priority' => null,
            'options'  => $options,
        ]);
    }
}
