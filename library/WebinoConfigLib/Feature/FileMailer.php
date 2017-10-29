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

use WebinoConfigLib\Mail\Transport;

/**
 * Class FileMailer
 */
class FileMailer extends AbstractMailer
{
    /**
     * @param string $path
     */
    public function __construct($path = null)
    {
        parent::__construct();
        $this->transport = new Transport\File($path);
    }
}
