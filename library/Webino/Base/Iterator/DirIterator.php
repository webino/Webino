<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2018 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace Webino\Base\Iterator;

/**
 * Class DirIterator
 */
class DirIterator extends \RegexIterator
{
    /**
     * Recursively returns files in provided directory path
     *
     * @param string $dir Target directory path
     * @param string $regEx Regular expression
     */
    public function __construct(string $dir, string $regEx)
    {
        $it = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator((string) $dir));
        parent::__construct($it, $regEx);
    }
}
