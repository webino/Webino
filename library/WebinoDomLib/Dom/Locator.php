<?php

namespace WebinoDomLib\Dom;

use WebinoDomLib\Exception\InvalidArgumentException;
use WebinoDomLib\Factory\LocatorStrategyFactory;

/**
 * Class Locator
 */
final class Locator
{
    /**
     * @var LocatorStrategyFactory
     */
    private $strategyFactory;

    /**
     * @var array
     */
    private $strategies = [];

    /**
     * @param NodeInterface $node
     * @param $locator
     * @return mixed
     */
    public function query(NodeInterface $node, $locator)
    {
        if (empty($node->ownerDocument)
            || !($node->ownerDocument instanceof Document)
        ) {
            throw new InvalidArgumentException('Expects node owner document');
        }

        return $node->ownerDocument->getXpath()->query($this->xpathMatchAny($locator), $node);
    }

    /**
     * @param LocatorStrategyFactory $factory
     * @return $this
     */
    public function setStrategyFactory(LocatorStrategyFactory $factory)
    {
        $this->strategyFactory = $factory;
        return $this;
    }

    /**
     * @return LocatorStrategyFactory
     */
    private function getStrategyFactory()
    {
        if (null === $this->strategyFactory) {
            $this->setStrategyFactory(new LocatorStrategyFactory);
        }
        return $this->strategyFactory;
    }

    /**
     * @param string $name Strategy name.
     * @return mixed
     */
    private function getStrategy($name)
    {
        if (empty($this->strategies[$name])) {
            $this->strategies[$name] = $this->getStrategyFactory()->create($name);
        }
        return $this->strategies[$name];
    }

    /**
     * @param string|array $locator
     * @return string
     */
    private function xpathMatchAny($locator)
    {
        if (empty($locator)) {
            return '';
        }

        $xpath = [];
        foreach ($this->normalizeLocator($locator) as $part) {
            $xpath[] = $this->locatorToXpath($this->normalizeLocatorPart($part));
        }
        return join('|', $xpath);
    }

    /**
     * @param string|array $locator
     * @return array
     */
    private function normalizeLocator($locator)
    {
        if (is_string($locator)) {
            return [$locator];
        } elseif (is_array($locator)) {
            return $locator;
        }

        // TODO exception
//        throw new UnexpectedValueException('Expected input as string or array, but provided ' . gettype($locator));
    }

    /**
     * @param string $locator
     * @return string
     */
    private function normalizeLocatorPart($locator)
    {
        if (false === strpos($locator, PHP_EOL)) {
            return $locator;
        }
        return preg_replace('~[[:space:]]+~', ' ', $locator);
    }

    /**
     * Select strategy and transform locator to XPath
     *
     * @param string $locator
     * @return string
     */
    private function locatorToXpath($locator)
    {
        $match = [];
        preg_match('~^(([a-z]+)\=)?(.+)~', $locator, $match);
        return $this->getStrategy($match[2])->locatorToXpath($match[3]);
    }
}
