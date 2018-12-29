<?php

namespace Webino;

/**
 * Class Route
 * @package webino-router
 */
final class Route implements RouteInterface
{
    /**
     * Route class
     *
     * @var string
     */
    private $class = '';

    /**
     * Route path
     *
     * @var string
     */
    private $path = '/';

    /**
     * Route default parameters
     *
     * @var array
     */
    private $defaults = [];

    /**
     * Route rules
     *
     * @var array
     */
    private $rules = [];

    /**
     * Route HTTP methods
     *
     * @var array
     */
    private $methods = [];

    /**
     * Route HTTP schemes
     *
     * @var array
     */
    private $schemes = [];

    /**
     * Route HTTP host
     *
     * @var string
     */
    private $host = '';

    /**
     * Route options
     *
     * @var array
     */
    private $options = [];

    /**
     * Route condition expression
     *
     * @var string
     */
    private $condition = '';

    /**
     * @param string $class
     * @param string $path
     */
    public function __construct(string $class, string $path)
    {
        $this->class = $class;
        $this->path = $path;
    }

    /**
     * Returns route class
     *
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * Returns route path
     *
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * Returns route default parameters
     *
     * @return array
     */
    public function getDefaults(): array
    {
        return $this->defaults;
    }

    /**
     * Set route default parameters
     *
     * @param array $defaults
     */
    public function setDefaults(array $defaults): void
    {
        $this->defaults = $defaults;
    }

    /**
     * @return array
     */
    public function getRules(): array
    {
        return $this->rules;
    }

    /**
     * @param array $rules
     */
    public function setRules(array $rules): void
    {
        $this->rules = $rules;
    }

    /**
     * Returns route HTTP methods
     *
     * @return array
     */
    public function getMethods(): array
    {
        return $this->methods;
    }

    /**
     * Set route HTTP methods
     *
     * @param array $methods
     */
    public function setMethods(array $methods): void
    {
        $this->methods = $methods;
    }

    /**
     * Returns route HTTP schemes
     *
     * @return array
     */
    public function getSchemes(): array
    {
        return $this->schemes;
    }

    /**
     * Set route HTTP schemes
     *
     * @param array $schemes
     */
    public function setSchemes(array $schemes): void
    {
        $this->schemes = $schemes;
    }

    /**
     * Returns route host name
     *
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * Set route host name
     *
     * @param string $host
     */
    public function setHost(string $host): void
    {
        $this->host = $host;
    }

    /**
     * Returns route options
     *
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * Set route options
     *
     * @param array $options
     */
    public function setOptions(array $options): void
    {
        $this->options = $options;
    }

    /**
     * Get route condition expression
     *
     * @return string
     */
    public function getCondition(): string
    {
        return $this->condition;
    }

    /**
     * Set route condition expression
     *
     * @param string $condition
     */
    public function setCondition(string $condition): void
    {
        $this->condition = $condition;
    }
}
