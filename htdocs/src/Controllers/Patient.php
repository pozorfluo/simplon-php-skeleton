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
    /**
     * 
     */
    public function runDefault(array $args = []): void
    {
        $this->set($args);


        // ($this->args['action'])()

        // echo '<pre>' . var_export($this->args, true) . '</pre><hr />';
        // echo '<pre>' . var_export($this, true) . '</pre><hr />';


        $this->serve();
    }
    /**
     * 
     */
    public function runList(array $args = []): void
    {
        $this->view = 'PatientList';
        $this->set($args);
        // echo '<pre>'.var_export($this, true).'</pre><hr />';


        // echo '<h2>LIST !!!</h2>';
        // echo '<pre>'.var_export($this->args['db_configs'], true).'</pre><hr />';

        $this->serve();
    }

    /**
     * 
     */
    public function runAdd(array $args = []): void
    {
        $this->set($args);


        // echo '<h2>Add !!!</h2>';
        // echo '<pre>'.var_export($this->args['db_configs'], true).'</pre><hr />';

        $this->serve();
    }
}
