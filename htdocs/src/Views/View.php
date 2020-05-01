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
    protected $args = [];
    protected $data = [];
    protected $components = [];

    public function __construct(array $args = [])
    {
        $this->args = $args;
    }

    /**
     * 
     */
    public function set(array $args): self
    {
        $this->args = array_merge(
            $this->args,
            $args
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
     * 
     * todo
     *   - [ ] Consider some form of memoization to avoid rendering the same 
     *         thing used at different places twice
     *     + [ ] Note that this only possible if render is pure
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
