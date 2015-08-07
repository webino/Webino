<?php

namespace WebinoAppLib\Options;

use Zend\Stdlib\AbstractOptions;

/**
 * Class DebuggerOptions
 */
class DebuggerOptions extends AbstractOptions
{
    /**
     * @var bool
     */
    protected $enabled = true;

    /**
     * @var bool|null
     */
    protected $mode = null;

    /**
     * @var bool
     */
    protected $bar = false;

    /**
     * @var bool
     */
    protected $strict = true;

    /**
     * @var string|null
     */
    protected $log;

    /**
     * @var string
     */
    protected $email = '';

    /**
     * @var int
     */
    protected $maxDepth = 10;

    /**
     * @var int
     */
    protected $maxLen = 300;

    /**
     * Is debugger enabled?
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * Is debugger disabled?
     *
     * @return bool
     */
    public function isDisabled()
    {
        return !$this->enabled;
    }

    /**
     * Debugger mode
     *
     * true  = production|false
     * false = development|null
     * null  = autodetect|IP address(es) csv/array
     *
     * @return bool|null
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * Is debugger bar enabled?
     *
     * @return bool
     */
    public function hasBar()
    {
        return $this->bar;
    }

    /**
     * @return bool
     */
    public function isStrict()
    {
        return $this->strict;
    }

    /**
     * @return string Empty string to disable, null for default
     */
    public function getLog()
    {
        if (null === $this->log) {
            $this->setLog('.');
        }
        return $this->log;
    }

    /**
     * Administrator address
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return int
     */
    public function getMaxDepth()
    {
        return $this->maxDepth;
    }

    /**
     * @return int
     */
    public function getMaxLen()
    {
        return $this->maxLen;
    }

    /**
     * Enable debugger
     *
     * @param bool $enabled
     * @return self
     */
    public function setEnabled($enabled)
    {
        $this->enabled = (bool) $enabled;
        return $this;
    }

    /**
     * Debugger mode, production or development.
     *
     * @param bool|null $mode
     * @return self
     */
    public function setMode($mode)
    {
        $this->mode = (null === $mode ? null : (bool) $mode);
        return $this;
    }

    /**
     * @param bool $bar
     * @return self
     */
    public function setBar($bar)
    {
        $this->bar = (bool) $bar;
        return $this;
    }

    /**
     * Strict errors?
     *
     * @param bool $strict
     * @return self
     */
    public function setStrict($strict)
    {
        $this->strict = (bool) $strict;
        return $this;
    }

    /**
     * Path to log directory
     *
     * @param string $log
     * @return self
     */
    public function setLog($log)
    {
        $this->log = realpath($log);
        return $this;
    }

    /**
     * Configure debugger administrator email
     *
     * @param string $email
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = (string) $email;
        return $this;
    }

    /**
     * Variable dump max depth
     *
     * @param int $maxDepth
     * @return self
     */
    public function setMaxDepth($maxDepth)
    {
        $this->maxDepth = (int) $maxDepth;
        return $this;
    }

    /**
     * Maximum length of a variable
     *
     * @param int $maxLen
     * @return self
     */
    public function setMaxLen($maxLen)
    {
        $this->maxLen = (int) $maxLen;
        return $this;
    }
}
