<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Debugger\Bar;

use Tracy\IBarPanel;
use WebinoHtmlLib\Html;

/**
 * Class AbstractPanel
 */
abstract class AbstractPanel implements IBarPanel
{
    /**
     * Resources sub directory
     */
    const RESOURCES = 'resources';

    /**
     * @var string
     */
    private $content;

    /**
     * @return string
     */
    abstract protected function getTitle();

    /**
     * @return string
     */
    protected function getLabel()
    {
        return '';
    }

    /**
     * @return string
     */
    protected function getDir()
    {
        return __DIR__ . '/' . $this::RESOURCES;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return $this
     */
    protected function setContent($content)
    {
        $this->content = (string) $content;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getTab()
    {
        return (new Html\InlineText($this->getLabel()))
            ->setTitle($this->getTitle())
            ->setClass('tracy-label');
    }

    /**
     * @param string $name
     * @param array $style
     * @return Html\Img
     */
    protected function createIcon($name, array $style = [])
    {
        $data   = file_get_contents($this->getDir() . '/' . $name . '.png');
        $base64 = 'data:image/png;base64,' . base64_encode($data);
        return (new Html\Img($base64))->setStyle($style);
    }

    /**
     * @param string $name
     * @return string
     */
    protected function renderTemplate($name)
    {
        ob_start();
        /** @noinspection PhpIncludeInspection */
        require $this->getDir() . '/' . $name . '.phtml';
        return ob_get_clean();
    }
}
