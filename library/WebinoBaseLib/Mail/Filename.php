<?php

namespace WebinoBaseLib\Mail;

/**
 * Class Filename
 */
class Filename
{
    /**
     * Returns name for a zend mail file
     */
    public static function create()
    {
        return 'ZendMail_' . microtime(true) . '.eml';
    }
}
