<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Factory;

use WebinoAppLib\Exception;
use WebinoConfigLib\Log\Writer;
use WebinoLogLib\Logger;
use WebinoLogLib\Factory;
use Zend\Log\Exception\InvalidArgumentException;

/**
 * Class LoggerFactory
 */
class LoggerFactory extends AbstractFactory
{
    /**
     * Application configuration key
     */
    const KEY = 'log';

    /**
     * Create a logger
     *
     * Set options for a logger. Accepted options are:
     * - writers: array of writers to add to this logger
     * - exceptionhandler: if true register this logger as exceptionhandler
     * - errorhandler: if true register this logger as errorhandler
     *
     * @return Logger
     * @throws Exception\InvalidArgumentException Unable to create a logger
     */
    protected function create()
    {
        try {
            return (new Factory)->create($this->resolveOptions());
        } catch (InvalidArgumentException $exc) {
            throw new Exception\InvalidArgumentException('Unable to create a logger', null, $exc);
        }
    }

    /**
     * Configures Noop (Null) log writer on empty options
     *
     * @return array|\Zend\Config\Config
     */
    private function resolveOptions()
    {
        $options = $this->getConfig($this::KEY);
        if (empty($options)) {
            return (new Writer([(new Writer\Noop)->toArray()]))->toArray();
        }
        return $options;
    }
}
