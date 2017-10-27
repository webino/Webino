<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Factory\View;

use WebinoAppLib\Factory\AbstractFactory;
use WebinoViewLib\Listener\SnippetsListener;
use WebinoViewLib\ViewTemplates;

/**
 * Class SnippetsListenerFactory
 */
class SnippetsListenerFactory extends AbstractFactory
{
    /**
     * Create a view snippets listener
     *
     * @return SnippetsListener
     */
    protected function create()
    {
        /** @var ViewTemplates $templates */
        $templates = $this->getServices()->get(ViewTemplates::class);
        return new SnippetsListener($templates);
    }
}
