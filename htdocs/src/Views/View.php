<?php

/**
 * 
 */

declare(strict_types=1);

namespace Views;

use Interfaces\Layoutable;

/**
 * 
 */
abstract class View implements Layoutable
{
    public $data = [];
    public $components = [];

    /**
     * 
     */
    public function getRaw(): array
    {
        return [
            'data' => $this->data,
            'components' => $this->components
        ];
    }

    /**
     * 
     */
    abstract public function compose();
    /**
     * Render components
     *   -> [string name => string rendered component]
     */
    abstract public function render(): array;
}
