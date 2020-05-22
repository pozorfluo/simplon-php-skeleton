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
    public function runDefault(array $args = []): void
    {
        $this->set($args);
        $this->serve();
    }

    /**
     * note
     *   from simplon-tp-product-hunt
     */
    // public function runLogout(array $args = []): void
    // {
    //     if (isset($_COOKIE['user_name'])) {
    //         setcookie('user_name', '', strtotime('-1 year'), '/');
    //     }

    //     header('Refresh: 0; url=/', TRUE, 302);
    //     exit();
    // }
}
