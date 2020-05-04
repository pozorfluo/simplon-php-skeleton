<?php

/**
 * 
 */

declare(strict_types=1);

namespace Controllers;

use Models\Model;
use Views\View;


/**
 * 
 */
class Patient extends Controller
{

    // public function __construct()
    // {
    //     parent::__construct();
    //     echo '<pre>Home()</pre>';
    // }
    
    /**
     * 
     */
    public function run(array $args = []): void
    {
        $this->set($args);
        
        // echo '<pre>' . var_export($this->template_args, true) . '</pre>';
        // echo '<pre>' . var_export($this->view, true) . '</pre>';
        $this->serve();
    }
}
