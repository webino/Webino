<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

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
