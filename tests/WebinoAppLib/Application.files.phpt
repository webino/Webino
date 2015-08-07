<?php

use BsbFlysystem\Service\AdapterManager;
use League\Flysystem\AdapterInterface;
use League\Flysystem\FileNotFoundException;
use League\Flysystem\FileExistsException;
use org\bovigo\vfs\vfsStream;
use Tester\Assert;
use WebinoAppLib\Feature\DefaultFilesystem;
use WebinoAppLib\Filesystem\LocalFiles;

require __DIR__ . '/../bootstrap.php';

$root = createTmpDir();

$config = Webino::config([
    new DefaultFilesystem($root),
]);


$app = Webino::application($config)->bootstrap();


$filesystem = $app->getFilesystem();

$files[0] = $app->file()->listContents();


Assert::exception(function () use ($app) {
    $app->file()->update('test-file.txt', 'test file content updated');
}, FileNotFoundException::class);

$app->file()->write('test-file.txt', 'test file content');

Assert::exception(function () use ($app) {
    $app->file()->write('test-file.txt', 'test file content override');
}, FileExistsException::class);

$testFileContent[0] = $app->file()->read('test-file.txt');

$app->file()->put('test-file.txt', 'test file content override');

$testFileContent[1] = $app->file()->read('test-file.txt');

$app->file()->update('test-file.txt', 'test file content updated');

$testFileContent[2] = $app->file()->read('test-file.txt');

$app->file()->put('test-file2.txt', 'test file 2 content');

$fileExists[0] = $app->file()->has('test-file2.txt');

$app->file()->write('test-new-dir/test-sub-dir/test-deep-file.txt', 'test deep-file content');

$fileExists[1] = $app->file()->has('test-new-dir/test-sub-dir');

$app->file()->rename('test-file2.txt', 'test-new-dir/test-file2-renamed.txt');

$app->file()->copy('test-new-dir/test-file2-renamed.txt', 'test-file2-copy.txt');

$testFileContent[3] = $app->file()->read('test-file2-copy.txt');

$app->file()->write('test-new-dir/test-sub-file.txt', 'test sub-file content');


$files[1] = $app->file()->listContents();
$files[2] = $app->file()->listFiles();
$files[3] = $app->file()->listContents('test-new-dir');

$paths[0] = $app->file()->listPaths();


$metaData[0] = $app->file()->getMimetype('test-file.txt');

$metaData[1] = $app->file()->getTimestamp('test-file.txt');

$metaData[2] = $app->file()->getSize('test-file.txt');


$app->file()->delete('test-file.txt');

$testFileContent[4] = $app->file()->readAndDelete('test-new-dir/test-file2-renamed.txt');

$app->file()->delete('test-file2-copy.txt');

$app->file()->deleteDir('test-new-dir/test-sub-dir');

$files[4] = $app->file()->listContents('test-new-dir');

$app->file()->deleteDir('test-new-dir');

$files[5] = $app->file()->listContents();

$app->file()->put('empty-dir/file.txt', '');

$fileExists[2] = $app->file()->has('empty-dir/file.txt');

$app->file()->emptyDir('empty-dir');

$files[6] = $app->file()->listContents('empty-dir');


// --- streams

$app->file()->write('test-stream-file.bak', str_repeat('x', 999999));
$stream = $app->file()->readStream('test-stream-file.bak');

Assert::exception(function () use ($app, $stream) {
    $app->file()->updateStream('backups/test-stream-file.bak', $stream);
}, FileNotFoundException::class);

$app->file()->writeStream('backups/test-stream-file.bak', $stream);

Assert::exception(function () use ($app, $stream) {
    $app->file()->writeStream('backups/test-stream-file.bak', $stream);
}, FileExistsException::class);

$app->file()->putStream('backups/test-stream-file.bak', $stream);

$fileExists[3] = $app->file()->has('backups/test-stream-file.bak');

$app->file()->updateStream('backups/test-stream-file.bak', $stream);

$app->file()->putStream('backups/test-stream-file2.bak', $stream);

$fileExists[4] = $app->file()->has('backups/test-stream-file2.bak');

fclose($stream);


Assert::true(isset($files[0]) && empty($files[0]));

Assert::same('file', $files[1][0]['type']);
Assert::same('test-file.txt', $files[1][0]['path']);

Assert::same('file', $files[1][1]['type']);
Assert::same('test-file2-copy.txt', $files[1][1]['path']);

Assert::same('dir', $files[1][2]['type']);
Assert::same('test-new-dir', $files[1][2]['path']);

Assert::same('file', $files[3][0]['type']);
Assert::same('test-new-dir/test-file2-renamed.txt', $files[3][0]['path']);

Assert::same('file', $files[3][0]['type']);
Assert::same('test-new-dir/test-file2-renamed.txt', $files[3][0]['path']);

Assert::same('dir', $files[3][1]['type']);
Assert::same('test-new-dir/test-sub-dir', $files[3][1]['path']);

Assert::same('file', $files[3][2]['type']);
Assert::same('test-new-dir/test-sub-file.txt', $files[3][2]['path']);

Assert::same('file', $files[4][0]['type']);
Assert::same('test-new-dir/test-sub-file.txt', $files[4][0]['path']);

Assert::same('test-file.txt', $paths[0][0]);
Assert::same('test-file2-copy.txt', $paths[0][1]);
Assert::same('test-new-dir', $paths[0][2]);

Assert::same('test file content', $testFileContent[0]);
Assert::same('test file content override', $testFileContent[1]);
Assert::same('test file content updated', $testFileContent[2]);
Assert::same('test file 2 content', $testFileContent[3]);
Assert::same('test file 2 content', $testFileContent[4]);

Assert::true($fileExists[0]);
Assert::true($fileExists[1]);
Assert::true($fileExists[2]);
Assert::true($fileExists[3]);
Assert::true($fileExists[4]);

Assert::same(3, count($files[1]));
Assert::same(2, count($files[2]));
Assert::same(3, count($files[3]));
Assert::same(1, count($files[4]));

Assert::same('text/plain', $metaData[0]);
Assert::true(is_int($metaData[1]));
Assert::same(25, $metaData[2]);

Assert::true(isset($files[5]) && empty($files[5]));
Assert::true(isset($files[6]) && empty($files[6]));
