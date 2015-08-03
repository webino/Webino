<?php
/**
 * Advanced usage example index file
 */

use WebinoAppLib\Application\CoreConfig;
use WebinoAppLib\Feature as AppFeature;
use WebinoConfigLib\Feature as ConfigFeature;

require 'vendor/autoload.php';

class MyCustomFeature extends ConfigFeature\AbstractFeature
{
    public function setAnything()
    {
        return $this;
    }
}

class MyCustomListener extends \WebinoEventLib\AbstractListener
{
    public function init()
    {
        $this->listen(\WebinoAppLib\Event\AppEvent::DISPATCH, function () {
            echo 'Webino Application Advanced Usage Example';
        });
    }
}


$config = new CoreConfig([
    new ConfigFeature\Log,
    new ConfigFeature\ConfigCacheEnabled,
    new AppFeature\FilesystemCache,

    (new MyCustomFeature)
        ->setAnything(),

    new AppFeature\Listener(MyCustomListener::class),
]);

$appCore = Webino::application($config);

$app = $appCore->bootstrap();

$app->dispatch();
