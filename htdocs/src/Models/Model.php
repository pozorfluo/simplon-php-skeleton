<?php

/**
 * 
 */

declare(strict_types=1);

namespace Models;

/**
 * note
 *   Base class Model describes how it is initialized, should be talked to, 
 *   what it gives back, forwards messages and its ability to invalidate cached 
 *   pages
 * 
 *   Where to get, how to get, how to massage the requested data is up to 
 *   derived classes
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
