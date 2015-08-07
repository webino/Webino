<?php

namespace WebinoBaseLib\Html;

use Zend\Escaper\Escaper;

/**
 * Class UrlHtml
 */
trait EscaperAwareTrait
{
    /**
     * @var Escaper
     */
    private $escaper;

    /**
     * @return Escaper
     */
    protected function getEscaper()
    {
        if (null === $this->escaper) {
            $this->setEscaper(new Escaper('utf-8'));
        }
        return $this->escaper;
    }

    /**
     * @param Escaper $escaper
     * @return self
     */
    public function setEscaper($escaper)
    {
        $this->escaper = $escaper;
        return $this;
    }
}
