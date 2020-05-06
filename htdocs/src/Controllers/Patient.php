<?php

/**
 * 
 */

declare(strict_types=1);

namespace Controllers;

use Helpers\DBConfig;
use Models\DBPDO;
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
        $this->set($args);
        $this->request['view'] = 'PatientList';

        $model = new DBPDO($this);

        //     for($i=0; $i<50; $i++){
        //     $results =  $model->execute(
        //         'patients',
        //         "INSERT INTO 
        //                     `patients` (`lastname`, `firstname`, `birthdate`, `phone`, `mail`)
        //                 VALUES
        //                     (?, ?, ?, ?, ?)
        //                     ;",
        //         [
        //             'lastname_' . substr(md5(strval(rand())), 0, 7),
        //             'firstname_' . substr(md5(strval(rand())), 0, 7),
        //             date('Y-m-d'),
        //             date('is-U'), // used as test phone
        //             substr(md5(strval(rand())), 0, 7) . '@mail.com',
        //         ]
        //     );
        // }

        // $t = microtime(true);
        $results =  $model->execute(
            'patients',
            "SELECT
                *
            FROM 
                `patients`;"
        );
        // echo '<pre>runList '.var_export((microtime(true) - $t), true).'</pre><hr />';
        $this->set(['data' => $results]);
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
