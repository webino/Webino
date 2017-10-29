<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

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
