<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoConfigLib\Feature;

use WebinoConfigLib\Exception;

/**
 * Class Logger
 */
class Logger extends AbstractFeature
{
    /**
     * Custom name
     */
    const NAME = null;

    /**
     * @param string|array|null $name
     * @param AbstractFeature[] $features
     */
    public function __construct($name = null, array $features = [])
    {
        parent::__construct();

        if (is_array($name)) {
            $features = $name;
            $name = $this::NAME;
        }

        if (!$name || (!is_string($name) && !is_array($name))) {
            throw (new Exception\InvalidArgumentException(
                'Expected name argument as string or overridden const NAME but got %s'
            ))->format($name);
        }

        foreach ($features as $feature) {
            $this->mergeArray([AbstractLog::KEY => [$name => current($feature->toArray())]]);
        }
    }
}
