<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoBaseLib\Iterator;

/**
 * Class RecursiveDirectoryRegexIterator
 */
class RecursiveDirectoryRegexIterator extends \RegexIterator
{
    /**
     * Recursively returns files in provided directory path
     *
     * @param string $dir Target directory path
     * @param string $regEx Regular expression
     * @param null $mode RegexIterator mode
     */
    public function __construct($dir, $regEx, $mode = null)
    {
        $it = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator((string) $dir));
        parent::__construct($it, $regEx, $mode);
    }
}
