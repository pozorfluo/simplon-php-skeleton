<?php

/**
 * 
 */

declare(strict_types=1);

namespace Controllers;

use Models\Model as Model;
use Views\View as View;


/**
 * 
 */
class Home extends Controller
{

    // public function __construct()
    // {
    //     parent::__construct();
    //     echo '<pre>Home()</pre>';
    // }
    /**
     * 
     */
    public function run(array $parameters = []): void
    {
        $this->set($parameters);
        
        // echo '<pre>' . var_export($this->template_parameters, true) . '</pre>';
        // echo '<pre>' . var_export($this->view, true) . '</pre>';
        $this->serve();
    }
}
