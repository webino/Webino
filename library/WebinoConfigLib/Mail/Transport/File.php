<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoConfigLib\Mail\Transport;

use WebinoBaseLib\Mail\Filename;

/**
 * Class File
 */
class File extends AbstractTransport
{
    /**
     * Create a file mail transport
     *
     * @param string $path Mail directory path
     */
    public function __construct($path = null)
    {
        $this->setType('file');
        $this->setOptions([
            'path'     => $path ? $path : 'tmp/mail',
            'callback' => Filename::class . '::create',
        ]);
    }
}
