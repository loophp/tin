<?php

namespace LeKoala\Tin\Algo;

/**
 * Base interface for a validation algorithm, as used in TINValid class
 */
interface TINAlgorithmInterface
{
    /**
     * Validate a tin number
     *
     * @param string $tin
     * @return int
     */
    public function isValid(string $tin);
}
