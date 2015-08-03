<?php

use BsbFlysystem\Service\FilesystemManager;
use League\Flysystem\Filesystem;
use Tester\Assert;
use WebinoAppLib\Application\CoreConfig;
use WebinoAppLib\Factory;
use WebinoAppLib\Feature\MemoryFilesystem;
use WebinoAppLib\Filesystem\InMemoryFiles;
use Zend\ServiceManager\ServiceLocatorInterface;

require __DIR__ . '/../bootstrap.php';


$config = new CoreConfig([
    new MemoryFilesystem,
]);


$app = (new Factory)->create($config)->bootstrap();


$filesystem = $app->getFilesystem();

$inMemoryFiles = $app->file(InMemoryFiles::class);

$app->file(InMemoryFiles::class)->put('test/file.txt', 'Example contents.');

$files = $app->file(InMemoryFiles::class)->listContents();


Assert::type(Filesystem::class, $inMemoryFiles);

Assert::false(empty($files));
