<?php

use BsbFlysystem\Service\FilesystemManager;
use League\Flysystem\Filesystem;
use Tester\Assert;
use WebinoAppLib\Feature\MemoryFilesystem;
use WebinoAppLib\Filesystem\InMemoryFiles;
use Zend\ServiceManager\ServiceLocatorInterface;

require __DIR__ . '/../bootstrap.php';


$config = Webino::config([
    new MemoryFilesystem,
]);


$app = Webino::application($config)->bootstrap();


$inMemoryFiles = $app->file(InMemoryFiles::class);

$app->file(InMemoryFiles::class)->put('test/file.txt', 'Example contents.');

$files = $app->file(InMemoryFiles::class)->listContents();


Assert::type(Filesystem::class, $inMemoryFiles);

Assert::false(empty($files));
