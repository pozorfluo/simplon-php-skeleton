<?php

/**
 * 
 */

declare(strict_types=1);

namespace Helpers;

use Controllers\Controller;

/**
 * 
 */
class Dispatcher
{
    protected $request;

    public function __construct()
    {
        $uri = $_SERVER['REQUEST_URI'];
        // echo '<pre>' . var_export($uri, true) . '</pre>';

        if (strpos($uri, 'index.php') || $uri = '/') {
            $this->request['controller']  = $_GET['controller'] ?? 'Patient';
            $this->request['action'] = $_GET['action'] ?? '';
            $this->request['parameters'] = $_GET['parameters'] ?? '';
        } else {
            $uri_bits = explode('/', $uri);
            $this->request['controller'] = $uri_bits[1];
            $this->request['action'] = $uri_bits[2];
            $this->request['parameters'] = $uri_bits[3];
        }

        $this->request['uri'] = $uri;
        // echo '<pre>' . var_export($this->request, true) . '</pre>';
    }

    public function call(): void
    {
        $controller = $this->load($this->request['controller']);
        call_user_func_array(
            [$controller, 'run'],
            [
                $this->request['action'],
                $this->request['parameters']
            ]
        );
    }
    public function load(string $controller_name): Controller
    {
        require('src/Controllers/' . $controller_name . '.php');
        $controller = new $controller_name();

        return $controller;
    }
}
