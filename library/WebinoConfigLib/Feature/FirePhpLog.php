<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

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
        parent::__construct();
        $this->writer = new Writer\FirePhp;
    }
}
