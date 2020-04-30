<?php

/**
 * 
 */

declare(strict_types=1);

namespace Entities;

use Interfaces\Validatable as Validatable;

/**
 * see https://www.php.net/manual/en/function.filter-var-array.php
 */
class Entity implements Validatable
{
    /**
     * [ string $field_name => mixed $value ]
     */
    protected $data;

    /**
     * [ string $field_name => mixed $filter_definition ]
     */
    protected $definition;

    /**
     * 
     */
    public function __construct(array $data, array $definition = [])
    {
        $this->data = $data;

        foreach (array_keys($data) as $field) {
            $this->definition[$field] = isset($definition[$field])
                ? [$field, $definition[$field]]
                : [$field => [
                    'filter' => FILTER_VALIDATE_REGEXP,
                    'options' => ['regexp' => '([A-Za-z0-9_\-\s]+)']
                ]];
        }
    }

    /**
     * 
     */
    public function getData(): array
    {
        return $this->data;
    }
    public function getDefinition(): array
    {
        return $this->data;
    }

    /**
     * 
     */
    public function isValid(): bool
    {
        return !in_array(
            false,
            filter_var_array($this->data, $this->definition),
            true // strict
        );
    }

    /**
     * Apply filter(s)
     */
    public function validate(): self
    {
        $this->data = filter_var_array($this->data, $this->definition);
        return $this;
    }
}
