<?php

/**
 * 
 */

declare(strict_types=1);

namespace Entities;

use Interfaces\Validatable;
use RecursiveArrayIterator;
use RecursiveIteratorIterator;

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
    protected $definitions;
    protected $is_valid;
    /**
     * 
     */
    public function __construct(array $data, array $definitions = [])
    {
        $this->data = $data;

        foreach (array_keys($data) as $field) {
            $this->definitions[$field] = isset($definitions[$field])
                ? $definitions[$field]
                : [
                    'filter' => FILTER_VALIDATE_REGEXP,
                    'options' => ['regexp' => '/^([A-Za-z0-9_\-\s]+)$/']
                ];

            // echo '<pre>' . var_export($this->definitions[$field], true) . '</pre>';
        }

        // $keys = array_keys($data);
        // $size = count($keys);
        // $i = 0;
        // while ($i < $size) {
        //     $field = $keys[$i];
        //     $this->definitions[$field] = isset($definitions[$field])
        //         ? [$field, $definitions[$field]]
        //         : [$field => [
        //             'filter' => FILTER_VALIDATE_REGEXP,
        //             'options' => ['regexp' => '/^([A-Za-z0-9_\-\s]+)$/']
        //         ]];
        //     $i++;
        // }
    }

    /**
     * 
     */
    public function getData(): array
    {
        return $this->data;
    }
    public function getDefinitions(): array
    {
        return $this->definitions;
    }

    /**
     * note
     *   Casting $field to bool is not satisfactory given php behaviour
     * 
     *   Use strict comparison against false or NULL as filter_var_array yields 
     *   a filtered value, false or NULL for missing keys 
     * 
     *   See https://www.php.net/manual/en/types.comparisons.php
     * */
    public function isValid(): bool
    {
        // $filtered = filter_var_array($this->data, $this->definitions);
        // $is_valid = 1;
        // $iterator = new RecursiveArrayIterator($filtered);
        // foreach (new RecursiveIteratorIterator($iterator) as $field) {
        //     $is_valid &= ($field === false || $field === NULL) ? 0 : 1;
        // }

        // /* $is_valid is either 0 or 1, casting to bool should be ok here */
        // return (bool) $is_valid;

        return $this->is_valid ?? !in_array(
            false,
            filter_var_array($this->data, $this->definitions),
            true // strict
        );
    }

    /**
     * Apply filter(s)
     */
    public function filter(): self
    {
        $this->data = filter_var_array($this->data, $this->definitions);
        return $this;
    }
    /**
     * Apply filter(s)
     */
    public function validate(): self
    {
        $this->data = filter_var_array($this->data, $this->definitions);
        return $this;
    }
}
