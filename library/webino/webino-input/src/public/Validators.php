<?php

namespace Webino;

/**
 * Class Validators
 * @package webino-input
 */
class Validators
{
    /**
     * @var iterable
     */
    private $collection = [];

    /**
     * Add validator to collection
     *
     * @param ValidatorInterface $validator
     * @return $this
     */
    function add(ValidatorInterface $validator)
    {
        $this->collection[get_class($validator)][] = $validator;
        return $this;
    }

    /**
     * Drop validator from collection
     *
     * @param string $validatorClass
     * @param ValidatorInterface $validator
     */
    function drop(string $validatorClass, ValidatorInterface $validator = null): void
    {
        if ($validator && !empty($this->collection[$validatorClass])) {
            foreach ($this->collection[$validatorClass] as $n => $subValidator) {
                if ($validator === $subValidator) {
                    unset($this->collection[$validatorClass][$n]);
                }
            }

            if (empty($this->collection[$validatorClass])) {
                unset($this->collection[$validatorClass]);
            }

        } else {
            unset($this->collection[$validatorClass]);
        }
    }

    /**
     * Returns true when data is valid
     *
     * @param mixed $data
     * @return bool
     */
    function validate($data): bool
    {
        $isValid = true;
        foreach ($this->collection as $validators) {
            foreach ($validators as $validator) {
                /** @var AbstractValidator $validator */
                $validator->validate($data) or $isValid = false;
            }
        }
        return $isValid;
    }
}
