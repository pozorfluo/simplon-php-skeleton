<?php

/**
 * 
 */

declare(strict_types=1);

namespace Interfaces;

/**
 * 
 */
interface Validatable
{
    /**
     * 
     */
    public function isValid(): bool;

    /**
     * Apply filter(s)
     */
    public function validate();

    /**
     * 
     */
    // public function raw(): array;
}
