<?php
/**
 * Config Feature
 * Webino Example
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
    const RESPONSE_TEXT = 'responseText';

    /**
     * @var string
     */
    private $responseText;

    public function __construct()
    {
        parent::__construct([
            $this::RESPONSE_TEXT => $this->responseText,
        ]);
    }

    /**
     * @param string $responseText
     * @return $this
     */
    public function setResponseText($responseText)
    {
        $this->responseText = (string) $responseText;
        return $this;
    }
}

$config = Webino::config([
    /**
     * Adding custom
     * config feature.
     */
    (new MyConfigFeature)->setResponseText('Hello Webino!'),
]);

$app = Webino::application($config)->bootstrap();

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    $event->setResponse([
        /**
         * Obtaining config
         * feature value.
         */
        $event->getApp()->getConfig(MyConfigFeature::RESPONSE_TEXT),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
