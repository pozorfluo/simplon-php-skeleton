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
        $this->set($args);
        /* 'escaping' and providing default action */
        $this->args['method'] =
            'op' . ($this->args['action'] ?? 'Fetch');

        /* use existing model or load one */
        if (method_exists(
            $this->model ?? $this->loadModel($this),
            $this->args['method']
        )) {
            /* requested mode of operation exists, run it */
            // $this->emit(['not implemented yet'], 405);
            $this->model->{$this->args['method']}();
        } else {
            /* mode of operation does NOT exist on this endpoint */
            $this->emit(['no can do'], 405);
        }
    }
}
