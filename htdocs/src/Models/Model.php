<?php

/**
 * 
 */

declare(strict_types=1);

namespace Models;

/**
 * note
 *   Geared towards PDO
 */
abstract class Model
{
    protected $db;
    /**
     * 
     */
    abstract public function execute(
        string $config_name,
        string $query,
        ?array $args = NULL,
        bool $transaction = false
    ): ?array;

    /**
     * 
     */
    abstract protected function transaction(
        string $query,
        ?array $args = NULL
    ): ?array;
}
