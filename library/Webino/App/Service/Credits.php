<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Service;

use WebinoBaseLib\Iterator\RecursiveDirectoryRegexIterator;

/**
 * Class Credits
 */
class Credits
{
    const VENDOR_COPYRIGHT = 'Copyright (c) 2015-2017 Webino, s.r.o.';
    const VENDOR_URL       = 'http://webino.sk';
    const AUTHOR_NAME      = 'Peter Bačinský';
    const AUTHOR_URL       = 'http://bacinsky.sk';

    /**
     * Returns parsed LICENSE info from vendor dir
     *
     * @param string $dir Vendor dir
     * @return array
     */
    public function getCredits($dir)
    {
        $credits = [];

        /** @var \SplFileInfo $file */
        foreach (new RecursiveDirectoryRegexIterator($dir, '/license.?.*$/i') as $file) {
            foreach (file($file->getPathname()) as $line) {
                if (0 === strpos($line, 'Copyright (c)')) {

                    $vendor  = basename(dirname($file->getPath()));
                    $package = basename($file->getPath());
                    $name    = ($vendor === 'vendor') ? $package : "$vendor/$package";

                    $credits[$name] = [$name, $line];
                }
            }
        }

        asort($credits);
        return $credits;
    }
}
