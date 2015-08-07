<?php
/**
 * Basic usage example application config
 */

use WebinoAppLib\Application\CoreConfig;
use WebinoAppLib\Feature as AppFeature;
use WebinoConfigLib\Feature as ConfigFeature;

require __DIR__ . '/../src/MyCustomListener.php';

return new CoreConfig([
    new ConfigFeature\Log,
    new ConfigFeature\ConfigCacheEnabled,
    new AppFeature\FilesystemCache,

    // (new MyCustomFeature)
    //    ->setAnything(),

    new AppFeature\Listener(MyCustomListener::class)
]);
