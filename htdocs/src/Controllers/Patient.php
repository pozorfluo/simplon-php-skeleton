<?php

/**
 * 
 */

declare(strict_types=1);

namespace Controllers;

use Helpers\DBConfig;
use Models\PDOModel;
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
        // echo '<pre>' . var_export($this, true) . '</pre><hr />';


        // echo '<h2>LIST !!!</h2>';
        // echo '<pre>'.var_export($this->args['db_configs'], true).'</pre><hr />';

        /**
         * todo
         *   - [ ] Consider this may fit better in the Model now we have 2-way
         *         communication
         */
        $db_config = new DBConfig($this->args['db_configs']);
        $model = new PDOModel($db_config);

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

        $results =  $model->execute(
            'patients',
            "SELECT
                *
            FROM 
                `patients`;"
        );
        // echo '<pre>' . var_export($results, true) . '</pre><hr />';
        $this->set(['data' => $results]);
        // echo '<pre>' . var_export($this->args, true) . '</pre><hr />';
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
