<?php

namespace WebinoAppLib\Debugger\Bar;

use Tracy\IBarPanel;
use WebinoAppLib\Exception;
use WebinoBaseLib\Html\ImgHtml;
use WebinoBaseLib\Html\InlineTextHtml;

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
    abstract protected function getLabel();

    /**
     * @return string
     */
    abstract protected function getTitle();

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
        return (new InlineTextHtml($this->getLabel()))
            ->setTitle($this->getTitle())
            ->setClass('tracy-label');
    }

    /**
     * {@inheritdoc}
     */
    protected function createIcon($name, $style = '')
    {
        $data   = file_get_contents($this->getDir() . '/' . $name . '.png');
        $base64 = 'data:image/png;base64,' . base64_encode($data);
        return (new ImgHtml($base64))->setStyle($style);
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
