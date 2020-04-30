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
    public function run(string $action = '', string $parameters = ''): void
    {
        $this->set(array('page_title' => 'Home'))
            ->set(['test_chain' => 'ch-chh-chaaaain'])
            ->set(['action' => $action]);

        
        // echo '<pre>' . var_export($this->template_parameters, true) . '</pre>';
        // echo '<pre>' . var_export($this->view, true) . '</pre>';
        $this->serve();
    }
}
