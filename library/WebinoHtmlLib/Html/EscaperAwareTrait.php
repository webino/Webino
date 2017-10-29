<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoHtmlLib\Html;

/**
 * Class EscaperAwareTrait
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
            $this->setEscaper(Escaper::getInstance());
        }
        return $this->escaper;
    }

    /**
     * @param Escaper $escaper
     * @return $this
     */
    public function setEscaper($escaper)
    {
        $this->escaper = $escaper;
        return $this;
    }
}
