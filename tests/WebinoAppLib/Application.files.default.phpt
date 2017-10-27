<?php

use BsbFlysystem\Service\FilesystemManager;
use League\Flysystem\Filesystem;
use Tester\Assert;
use Zend\ServiceManager\ServiceLocatorInterface;

require __DIR__ . '/../bootstrap.php';


$app = Webino::application()->bootstrap();


$filesystems = $app->getFiles();
$defaultFiles = $app->file();
$files = $app->file()->listContents();


Assert::type(FilesystemManager::class, $filesystems);
Assert::type(ServiceLocatorInterface::class, $filesystems);
Assert::type(Filesystem::class, $defaultFiles);
Assert::false(empty($files));
