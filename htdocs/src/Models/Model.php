<?php

/**
 * 
 */

declare(strict_types=1);

namespace Models;

use Controllers\Controller;
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

    public function __construct(Controller $controller)
    {
        /**
         * todo
         *   - [ ] Explore ways of sending message upstream
         */
        $this->controller = $controller;

        /**
         * todo
         *   - [ ] Explore what php does here
         *     + [ ] Figure out if it is a copy (how deep ?), a reference ?
         *     + [ ] Compare modifying it directly if its a reference vs
         *           vs using reference to controller->set()
         * 
         * note
         *   Error: Cannot access protected property Controllers\Home::$args 
         *          in /shared/httpd/hello-php/htdocs/src/Views/View.php
         *   A decent hint that it is a reference
         */
        $this->args = $controller->args;
    }
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
