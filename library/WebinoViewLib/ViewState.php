<?php

namespace WebinoViewLib;

/**
 * Class ViewState
 */
class ViewState
{
    /**
     * Variable placeholder
     */
    const VAR_PLACEHOLDER = '~\{\$(_?[^\}]+)\}~';

    /**
     * @var callable[]
     */
    private $resolvers = [];

    /**
     * @var array
     */
    private $cache;

    /**
     * @param callable $resolver
     */
    public function setResolver(callable $resolver)
    {
        $this->resolvers[] = $resolver;
        return $this;
    }

    /**
     * @param string $string
     * @return mixed
     */
    public function format($string)
    {
        $matches = [];
        preg_match_all($this::VAR_PLACEHOLDER, $string, $matches);
        if (empty($matches[1])) {
            return $string;
        }

        foreach ($matches[1] as $index => $name) {
            $result = null;
            foreach ($this->resolvers as $resolver) {
                $result = isset($this->cache[$name]) ? $this->cache[$name] : call_user_func($resolver, $name);
                $result and $string = str_replace($matches[0][$index], $result, $string);
            }
        }

        return preg_replace($this::VAR_PLACEHOLDER, null, $string);;
    }
}
