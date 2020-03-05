<?php

namespace LeKoala\Tin\Algo;

/**
 * Base class for all algorithms
 */
abstract class TINAlgorithm implements TINAlgorithmInterface
{
    /**
     * Validate a tin number
     *
     * @param string $tin
     * @return integer
     */
    public function isValid(string $tin)
    {
        return $this->validate($tin);
    }

    /**
     * @param string $tin
     * @return integer A value from StatusCode class
     */
    public abstract function validate(string $tin);
}
