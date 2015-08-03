<?php

use BsbFlysystem\Service\FilesystemManager;
use League\Flysystem\Filesystem;
use Tester\Assert;
use WebinoAppLib\Application\CoreConfig;
use WebinoAppLib\Factory;
use WebinoAppLib\Filesystem\InMemoryFiles;
use Zend\ServiceManager\ServiceLocatorInterface;

require __DIR__ . '/../bootstrap.php';


$app = (new Factory)->create()->bootstrap();


$filesystem = $app->getFilesystem();

$defaultFiles = $app->file();

$files = $app->file()->listContents();


Assert::type(FilesystemManager::class, $filesystem);
Assert::type(ServiceLocatorInterface::class, $filesystem);

Assert::type(Filesystem::class, $defaultFiles);

Assert::false(empty($files));
