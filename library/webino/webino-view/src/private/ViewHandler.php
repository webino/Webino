<?php

namespace Webino;

/**
 * Class ViewHandler
 * @package webino-view
 */
class ViewHandler extends AbstractViewHandler
{
    /**
     * Returns views query XPath
     *
     * @return string
     */
    protected function getQueryXpath(): string
    {
        return '//*[starts-with(name(), "view-")]';
    }

    /**
     * Setup view for each node
     *
     * @param HtmlNode $node
     * @param InstanceContainerInterface $container
     */
    protected function eachNode(HtmlNode $node, InstanceContainerInterface $container): void
    {
        $nodeName = $node->getName();
        $class = (new Filter\DashCaseToCamelCase)->filter(substr($nodeName, 5));
        $view = $container->get("\Webino\\{$class}View");
        $this->addViewItem($class, new ViewHandlerItem($view, $node));
    }
}
