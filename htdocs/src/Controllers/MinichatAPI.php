<?php

/**
 * 
 */

declare(strict_types=1);

namespace Controllers;

use Models\Model;

/**
 * 
 */
class MinichatAPI extends API
{
    /**
     * note
     *   Prepend all model modes of operation meant to be callable by a request
     *   with 'op'
     */
    public function runDefault(array $args = []): void
    {
        
        /* set model, args, etc ... then call() */
        $this->set($args);
        $this->call();
    }
}
