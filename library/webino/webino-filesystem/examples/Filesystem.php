<?php

// TODO filesystem examples

//    $file = $app->getFile('../system/html/layout.html');
//    $file = $app->getFile('\Webino\LocalFile://../system/html/layout.html');
//    $file = $app->getFile('local://../system/html/layout.html');

//    $app->getFilesystem()->setDefaultFileScheme('LinuxSftp');
//    $app->getFilesystem()->setFileSchemeAlias('LinuxSftp', 'sftp');


//$file = $app->getFile('sftp://Webino/www/experimental/webino/system/html/layout.html');
//$file = $app->getFile('LinuxSftp://.bash_history');

//$file->getPath();
//$file->getContents();


// register system views
// TODO forRegex() example
//foreach ($app->getFileList('../system/views')->withExtension('txt', 'php') as $path) {
//    echo $path  . '<br>';
//}

// register system views
//foreach ($app->getFileList('../system/views')->withExtension('php') as $node) {
//    ///** @var \DirectoryIterator $node */
//    //var_dump($node->getPath());
//    die($node->asFile()->getContents());
//}
