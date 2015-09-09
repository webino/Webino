<?php

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
        $this->transport = new Transport\File($path);
    }
}
