<?php
/**
 * Config Feature
 * Webino example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;
use WebinoConfigLib\Feature\AbstractFeature;

require __DIR__ . '/../../vendor/autoload.php';

/**
 * Custom config feature
 */
class MyConfigFeature extends AbstractFeature
{
    public function __construct()
    {
        $this->mergeArray([
            'responseText' => 'Hello Webino!',
        ]);
    }
}

$config = Webino::config([
    /**
     * Adding custom
     * config feature.
     */
    new MyConfigFeature,
]);

$app = Webino::application($config)->bootstrap();

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    $event->setResponseContent([
        /**
         * Obtaining config
         * feature value.
         */
        $event->getApp()->getConfig('responseText'),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();