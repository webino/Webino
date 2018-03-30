<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2018 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

use Tester\Assert;
use Webino\Base\Iterator\DirIterator;
use Webino\Dev\Filesystem\VirtualFilesystem;

require __DIR__ . '/../../bootstrap.php';


$vfs = new VirtualFilesystem([
    'dir1' => ['file1.txt' => ''],
    'dir2' => [
        'sub-dir1',
        'sub-dir2' => ['sub-file2.txt' => ''],
    ],
]);

$dir = $vfs->url('/');

$iterator = new DirIterator($dir, '~2\.txt~');
$iterator->next();
/** @var SplFileInfo $file */
$file = $iterator->current();


Assert::same('sub-file2.txt', $file->getFilename());
