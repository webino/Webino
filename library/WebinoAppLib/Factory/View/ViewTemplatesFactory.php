<?php

namespace WebinoAppLib\Factory\View;

use WebinoAppLib\Factory\AbstractFactory;
use WebinoAppLib\Feature\DefaultView;
use WebinoViewLib\ViewTemplates;

/**
 * Class ViewTemplatesFactory
 */
class ViewTemplatesFactory extends AbstractFactory
{
    /**
     * Create a view templates manager
     *
     * @return ViewTemplates
     */
    protected function create()
    {
        $paths = $this->getConfig(DefaultView::KEY)['templates'];
        $templates = new ViewTemplates;
        $paths and $templates->setMap($paths->toArray());
        return $templates;
    }
}
