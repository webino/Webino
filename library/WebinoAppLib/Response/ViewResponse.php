<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Response;

use WebinoAppLib\Event\DispatchEvent;
use WebinoAppLib\Event\SendResponseEvent;
use WebinoDomLib\Dom;
use WebinoViewLib\ViewTemplates;

/**
 * Class ViewResponse
 * @TODO redesign
 */
class ViewResponse extends HtmlResponse implements
    OnResponseInterface
{
    /**
     * Default view layout
     */
    const DEFAULT_LAYOUT = '<!DOCTYPE html><html><head></head><body></body></html>';

    /**
     * @var Dom\Config
     */
    private $cfg;

    /**
     * @var array
     * @TODO
     */
    private $cfgPaths = [];

    /**
     * @var string
     */
    private $layout;

    /**
     * @param $name
     * @return Dom\Config\SpecConfig
     */
    public function get($name)
    {
        return $this->getCfg()->get($name);
    }

    /**
     * @param string|Dom\Config\SpecConfig $name
     * @return Dom\Config\SpecConfig
     */
    public function set($name)
    {
        return $this->getCfg()->set($name);
    }

    /**
     * @return Dom\Config
     */
    public function getCfg()
    {
        if (null === $this->cfg) {
            $this->setCfg(new Dom\Config);
        }
        return $this->cfg;
    }

    /**
     * @param Dom\Config $cfg
     * @return $this
     */
    public function setCfg(Dom\Config $cfg)
    {
        $this->cfg = $cfg;
        return $this;
    }

    // TODO
    public function addCfg($path)
    {
        $this->cfgPaths[] = $path;
        return $this;
    }

    /**
     * @return string
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * @param string $layout
     * @return $this
     */
    public function setLayout($layout)
    {
        $this->layout = (string) $layout;
        return $this;
    }

    /**
     * @param DispatchEvent $event
     */
    public function onResponse(DispatchEvent $event)
    {
        // TODO constant
        $this->addCfg('common');

        $app = $event->getApp();
        $cfg = $this->getCfg();

        // TODO refactor
        foreach ($this->cfgPaths as $cfgPath) {
            /** @var \WebinoAppLib\Application\Config $spec */
            $spec = $app->getConfig('view')[$cfgPath];
            $spec and $cfg->setToMerge($spec->toArray());
        }

        /** @var ViewTemplates $templates */
        $templates = $app->get(ViewTemplates::class);
        $layout = $this->getLayout();
        $doc = new Dom($layout ? $templates->resolve($layout) : $this::DEFAULT_LAYOUT);

        /** @var Dom\Renderer $renderer */
        $renderer = $app->get(Dom\Renderer::class);
        $renderer->render($doc, $cfg);

        // TODO concept
        $app->bind(SendResponseEvent::class, function () use ($doc, $event) {

            /** @var \Zend\Http\PhpEnvironment\Request $request */
            $request = $event->getRequest();

            // TODO strategies
            $isAjax = $request->isXmlHttpRequest();
            if ($isAjax) {

                $frags = $this->createFragments($doc, '.ajax-fragment');

                $this->setContent(json_encode($frags));
                $this->setContentType('application/json');

                return;
            }

            // TODO strategies
            $this->setContent((string) $doc);
        }, SendResponseEvent::BEFORE);
    }

    // TODO concept
    public function createFragments($dom, $xpath)
    {
        $data = [];
        foreach ($dom->locate($xpath) as $node) {
            $id = $node->getAttribute('id');
            if (empty($id)) {
                // TODO exception
                throw new \RuntimeException('Required ajax fragment element id');
            }
            $data['fragments']['#' . $id] = $node->getOuterHtml();
        }
        return $data;
    }
}
