<?php

/**
 * 
 */

declare(strict_types=1);

namespace Interfaces;

/**
 * 
 */
interface ITemplate
{
    /**
     * 
     */
    public function get(): array;

    /**
     * 
     */
    public function render(): void;
}
