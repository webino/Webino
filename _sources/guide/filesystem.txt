.. rst-class:: sub-monospace

======================
Application Filesystem
======================

.. contents::
    :depth: 1
    :local:


The Webino™ filesystem provides simple to use drivers for working with local filesystems, Azure, Amazon S3,
Copy.com, Dropbox, (S)FTP, GridFS, Memory, Rackspace, WebDAV, PHPCR and ZipArchive. [**TODO**]

- Powered by `Flysystem <http://flysystem.thephpleague.com>`_


Filesystem Interface
^^^^^^^^^^^^^^^^^^^^

.. contents::
    :depth: 1
    :local:


.. note::
    All paths used by Filesystem API are relative to its adapter root directory.


$app->getFilesystems()
----------------------

Accessing filesystem manager service.

.. code-block:: php

    /** @var \Zend\ServiceManager\ServiceLocatorInterface $filesystems */
    $filesystems = $app->getFilesystems();


.. _api-filesystem-app-file:

$app->file()
------------

Obtaining filesystem instance.

.. code-block:: php

    use WebinoAppLib\Filesystem\LocalFiles;
    use WebinoAppLib\Filesystem\InMemoryFiles;

    // default filesystem
    $localFiles = $app->file();
    // or
    $localFiles = $app->file(LocalFiles::class);

    // different filesystem
    $inMemoryFiles = $app->file(InMemoryFiles::class);


$app->file()->write()
---------------------

Write files, throws an exception if the file already exists.

.. code-block:: php

    $app->file()->write('path/to/file.txt', 'File content example.');


$app->file()->update()
----------------------

Update files, throws an exception if the file does not exists.

.. code-block:: php

    $app->file()->update('path/to/file.txt', 'File content example updated.');


$app->file()->put()
-------------------

Write or update files.

.. code-block:: php

    $app->file()->put('path/to/file.txt', 'File content example.');


$app->file()->read()
--------------------

Read files.

.. code-block:: php

    $contents = $app->file()->read('path/to/file.txt');


$app->file()->has()
-------------------

Check if a file exists.

.. code-block:: php

    $exists = $app->file()->has('path/to/file.txt');


$app->file()->delete()
----------------------

Delete files.

.. code-block:: php

    $app->file()->delete('path/to/file.txt');


$app->file()->readAndDelete()
-----------------------------

Read and delete files.

.. code-block:: php

    $contents = $app->file()->readAndDelete('path/to/file.txt');


$app->file()->rename()
----------------------

Rename files.

.. code-block:: php

    $app->file()->rename('path/to/file.txt', 'path/to/new-file.txt');


$app->file()->copy()
--------------------

Copy files.

.. code-block:: php

    $app->file()->copy('path/to/file.txt', 'path/to/file-copy.txt');


$app->file()->getMimetype()
---------------------------

Get MIME types.

.. code-block:: php

    $mimetype = $app->file()->getMimetype('path/to/file.txt');


$app->file()->getTimestamp()
----------------------------

Get timestamps.

.. code-block:: php

    $timestamp = $app->file()->getTimestamp('path/to/file.txt');


$app->file()->getSize()
-----------------------

Get file sizes.

.. code-block:: php

    $size = $app->file()->getSize('path/to/file.txt');


$app->file()->createDir()
-------------------------

Create directories.

.. code-block:: php

    $app->file()->createDir('path/to/new/directory');


Directories are also made implicitly when writing to a deeper path.

.. code-block:: php

    $app->file()->write('path/to/file.txt', 'File content example.');


$app->file()->deleteDir()
-------------------------

Delete directories.

.. code-block:: php

    $app->file()->deleteDir('path/to/directory');


$app->file()->emptyDir()
------------------------

Empty directories.

.. code-block:: php

    $app->file()->emptyDir('path/to/directory');


$app->file()->listContents()
----------------------------

List contents, returns array of info of the files and folders.

.. code-block:: php

    $contents = $app->file()->listContents('path/to/directory', $recursive = false);

    // non-recursive root by default
    $contents = $app->file()->listContents();


$app->file()->listPaths()
-------------------------

List paths, returns array of paths of the files and folders.

.. code-block:: php

    $paths = $app->file()->listPaths('path/to/directory', $recursive = false);

    // non-recursive root by default
    $paths = $app->file()->listPaths();


$app->file()->listFiles()
-------------------------

List files, returns array of paths of the files.

.. code-block:: php

    $files = $app->file()->listFiles('path/to/directory', $recursive = false);

    // non-recursive root by default
    $files = $app->file()->listFiles();


$app->file()->writeStream()
---------------------------

Write files using stream, throws an exception if the file already exists.

.. code-block:: php

    $app->file()->writeStream('path/to/file.txt', $stream);


$app->file()->updateStream()
----------------------------

Update files using stream, throws an exception if the file does not exists.

.. code-block:: php

    $app->file()->updateStream('path/to/file.txt', $stream);


$app->file()->putStream()
-------------------------

Write or update files using stream.

.. code-block:: php

    $app->file()->putStream('path/to/file.txt', $stream);


$app->file()->readStream()
--------------------------

Read files using stream.

.. code-block:: php

    $stream = $app->file()->readStream('path/to/file.txt');


Filesystem Config
^^^^^^^^^^^^^^^^^

.. contents::
    :depth: 1
    :local:

.. include:: /guide/config/filesystem.rst.inc


Configuring Filesystem
^^^^^^^^^^^^^^^^^^^^^^

TODO...


Working With Streams
^^^^^^^^^^^^^^^^^^^^

TODO...
