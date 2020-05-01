<?php

/**
 * 
 */

declare(strict_types=1);

namespace Helpers;

use Controllers\Controller;

/**
 * index.php?controller=Home&action=value&p1=v1&p2=v2&pn=vn"
 *   or ?
 * /Controller/Action/p1=v1&p2=v2&pn=vn
 */
class Dispatcher
{
    protected $request;
    protected $controller;

    public function __construct()
    {
        // $uri = $_SERVER['REQUEST_URI'];

        //     $uri_bits = explode('/', $uri);
        //     $this->request['controller'] = $uri_bits[1];
        //     $this->request['action'] = $uri_bits[2];
        //     parse_str($uri_bits[3], $this->request['args']);

        parse_str($_SERVER['QUERY_STRING'], $this->request);
        if(!isset($this->request['controller'])){
            $this->request['controller'] = 'Home';
        }
    }

    /**
     * 
     */
    public function call(): self
    {
        $this->controller ?? $this->load();
        unset($this->request['controller']);

        $this->controller->run($this->request);

        return $this;
    }
    /**
     * 
     */
    public function load(): self
    {
        require('src/Controllers/' . $this->request['controller'] . '.php');
        $controller_name = '\Controllers\\' . $this->request['controller'];
        $this->controller = new $controller_name();

        return $this;
    }
}