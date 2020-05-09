<?php

/**
 * Dirty concurrent PDO hack companion + hello memcached
 */

declare(strict_types=1);

define('ROOT', __DIR__ . '/../../');

require ROOT . 'src/Helpers/AutoLoader.php';

use \Helpers\DBConfig as DBConfig;
use \Models\HelloPdo as HelloPdoModel;

echo '<pre>' . var_export(ROOT . '.env', true) . '</pre>';

$db_configs = new DBConfig(ROOT . '.env');
$model = new HelloPdoModel($db_configs);

// hello-php.loc/src/Helpers/Fork.php?t=2
$t = filter_input(INPUT_GET, 't', FILTER_SANITIZE_STRING);

switch ($t) {
    case 0:
        $query = [
            'config' => 'colyseum',
            'query' => "SELECT
                        `firstName` AS `first name`
                    FROM 
                        `clients` 
                    ORDER BY 
                        `firstName` ASC
                    LIMIT
                        3;"
        ];
        break;
    case 1:
        $query = [
            'config' => 'colyseum',
            'query' => "SELECT
                        `id`
                    FROM 
                        `clients` 
                    ORDER BY 
                        `id` ASC
                    LIMIT
                        3;"
        ];
        break;
    case 2:
        $query = [
            'config' => 'colyseum',
            'query' => "SELECT
                        `id`,
                        `lastName` AS `last name`,
                        `firstName` AS `first name`,
                        `birthDate` AS `date of birth`,
                        `card` AS `has a card ?`,
                        `cardNumber` AS `card number`
                    FROM 
                        `clients` 
                    ORDER BY 
                        `lastName` ASC
                    LIMIT
                        3;"
        ];
        break;
}



// $mc = new Memcached('sdf');

// $mc_host = [
//     'host' => 'localhost',
//     'port' => 11211,
//     'type' => 'TCP',
// ];

// if (!in_array($mc_host, $mc->getServerList())) {
//     $mc->addServer("localhost", 11211);
// }
// echo '<pre>' . var_export($mc->getServerList(), true) . '</pre>';
// echo '<pre>' . var_export($mc->getStats(), true) . '</pre>';
// echo '<pre>' . var_export($mc->getVersion(), true) . '</pre>';

// if (!($cached = $mc->get('t' . $t))) {
//     echo 'Serving Fresh ! <br />';
//     $results =  $model->execute(
//         $query['config'],
//         $query['query']
//     );
//     $mc->set('t' . $t, $results);
// } else {
//     echo 'Serving Cached ! <br />';
//     $results = $cached;
// }


// echo '<pre>' . var_export($mc, true) . '</pre>';
// echo '<pre>' . var_export($mc->quit(), true) . '</pre>';
// echo '<pre>' . var_export($results, true) . '</pre>';


$iterations = 10000;


$t = microtime(true);
$i   = 0;
while ($i < $iterations) {
    $results =  $model->execute(
        $query['config'],
        $query['query']
    );
    ++$i;
}
echo '<pre>' . var_export('baseline :' . (microtime(true) - $t), true) . '</pre>';
echo '<pre>' . var_export($results, true) . '</pre>';

$t = microtime(true);
$i   = 0;
while ($i < $iterations) {
    $mc = new Memcached('sdf');

    $mc_host = [
        'host' => 'localhost',
        'port' => 0,
        'type' => 'TCP',
    ];

    if (!in_array($mc_host, $mc->getServerList())) {
        $mc->addServer("localhost", 11211);
    }

    if (!($cached = $mc->get('t' . $t))) {
        // echo 'Serving Fresh ! <br />';
        $results =  $model->execute(
            $query['config'],
            $query['query']
        );
        $mc->set('t' . $t, $results);
    } else {
        // echo 'Serving Cached ! <br />';
        $results = $cached;
    }
    ++$i;
}
echo '<pre>' . var_export('memcached :' . (microtime(true) - $t), true) . '</pre>';
echo '<pre>' . var_export($results, true) . '</pre>';


//------------------------------------------------------------------------------
// class Fork
// {
//     private $_handles = array();
//     private $_mh      = array();

//     function __construct()
//     {
//         $this->_mh = curl_multi_init();
//     }

//     function add($url)
//     {
//         $ch = curl_init();
//         curl_setopt($ch, CURLOPT_URL, $url);
//         curl_setopt($ch, CURLOPT_HEADER, 0);
//         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//         curl_setopt($ch, CURLOPT_TIMEOUT, 30);
//         curl_multi_add_handle($this->_mh, $ch);
//         $this->_handles[] = $ch;
//         return $this;
//     }

//     function run()
//     {
//         $running = null;
//         do {
//             curl_multi_exec($this->_mh, $running);
//             usleep(250000);
//         } while ($running > 0);
//         for ($i = 0; $i < count($this->_handles); $i++) {
//             $out = curl_multi_getcontent($this->_handles[$i]);
//             $data[$i] = json_decode($out);
//             curl_multi_remove_handle($this->_mh, $this->_handles[$i]);
//         }
//         curl_multi_close($this->_mh);
//         return $data;
//     }
// }

// $fork = new Fork;

// $output = $fork->add('http://hello-php.loc/src/Helpers/Fork.php?t=1')
//     ->add('http://hello-php.loc/src/Helpers/Fork.php?t=1')
//     ->add('http://hello-php.loc/src/Helpers/Fork.php?t=2')
//     ->run();

// echo "<pre>";
// print_r($output);
// echo "</pre>";