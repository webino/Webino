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
 * Class Mock
 */
class Mock extends AbstractWriter
{
    /**
     * Create a mock log writer
     */
    public function __construct()
    {
        $this->mergeArray(['name' => 'mock']);
    }
}
