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
    protected $parameters = [];
    protected $data = [];
    protected $components = [];

    public function __construct(array $parameters = [])
    {
        if (!empty($parameters)) {
            $this->parameters = array_merge(
                $this->parameters,
                $parameters
            );
        }
    }

    /**
     * 
     */
    public function set(array $parameters): self
    {
        $this->parameters = array_merge(
            $this->parameters,
            $parameters
        );
        return $this;
    }

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
     * Render components
     *   -> [string name => string rendered component]
     */
    public function render(): array
    {
        foreach ($this->components as $key => $batch) {
            $rendered_batch = '';
            foreach ($batch as $component) {
                $rendered_batch .= $component->render();
            }
            $this->components[$key] = $rendered_batch;
        }
        return $this->components;
    }
    /**
     * 
     */
    abstract public function compose();
}
