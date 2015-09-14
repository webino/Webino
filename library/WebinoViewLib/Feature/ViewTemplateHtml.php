<?php

namespace WebinoViewLib\Feature;

use WebinoConfigLib\Config;
use WebinoConfigLib\Feature\FeatureInterface;

/**
 * Class ViewTemplateHtml
 */
class ViewTemplateHtml extends Config implements
    FeatureInterface,
    ViewConfigInterface,
    ViewTemplatesConfigInterface
{
    /**
     * @param string $name
     * @param string $html
     */
    public function __construct($name, $html)
    {
        parent::__construct([[$this::VIEW => [$this::TEMPLATES => [$name => $html]]]]);
    }
}
