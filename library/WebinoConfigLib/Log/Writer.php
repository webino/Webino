<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoConfigLib\Log;

use WebinoConfigLib\AbstractConfig;

/**
 * Class Writer
 */
class Writer extends AbstractConfig
{
    /**
     * @param array $writers
     */
    public function __construct(array $writers)
    {
        $this->mergeArray(['writers' => $writers]);
    }
}
