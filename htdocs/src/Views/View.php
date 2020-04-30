<?php

/**
 * 
 */

declare(strict_types=1);

namespace Views;

use Interfaces\ITemplate;

/**
 * 
 */
abstract class View implements ITemplate
{
    public $data;
    public $components;

    /**
     * 
     */
    abstract public function get(): array;

    /**
     * 
     */
    abstract public function render(): void;
    
    /**
     * 
     */
    abstract public function compose(): void;
}
