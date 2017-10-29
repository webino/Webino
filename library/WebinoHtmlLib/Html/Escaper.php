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

use WebinoBaseLib\Util\SingletonTrait;
use Zend\Escaper\Escaper as BaseEscaper;

/**
 * Escaper Singleton
 */
class Escaper extends BaseEscaper
{
    use SingletonTrait;

    /**
     * {@inheritdoc}
     */
    public function __construct($encoding = 'utf-8')
    {
        parent::__construct($encoding);
    }
}
