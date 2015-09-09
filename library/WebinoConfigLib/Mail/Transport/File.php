<?php

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
