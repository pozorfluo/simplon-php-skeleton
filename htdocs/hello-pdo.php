<?php

declare(strict_types=1);
require_once 'src/AutoLoader.php';

use \Helpers\DBConfig as DBConfig;
use \Models\HelloPdo as HelloPdoModel;

//------------------------------------------------------------------ session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$page_title = 'hello-pdo';

require 'src/head.php';
?>

<body>
    <?php require 'src/nav.php'; ?>
    <hr />

    <?php

    $exercises = [
        'Part1 ex1' => [
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
                        `lastName` ASC;"
        ],
        'Part1 ex2' => [
            'config' => 'colyseum',
            'query' => "SELECT
                        `id`,
                        `type` AS `show type`
                    FROM 
                        `showTypes` 
                    ORDER BY 
                        `id` ASC;"
        ],
        'Part1 ex3' => [
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
                            `id` ASC
                        LIMIT 
                            20;"
        ],
        'Part1 ex4' => [
            'config' => 'colyseum',
            'query' => "SELECT
                            `clients`.`id`,
                            `lastName` AS `last name`,
                            `firstName` AS `first name`,
                            `birthDate` AS `date of birth`,
                            `clients`.`cardNumber` AS `card number`
                        FROM 
                            `clients` 
                        INNER JOIN
                            `cards` ON `clients`.`cardNumber` = `cards`.`cardNumber`
                        WHERE
                            `cards`.`cardTypesId` = 1
                        ORDER BY 
                            `clients`.`id` ASC;"
        ],
        'Part1 ex5' => [
            'config' => 'colyseum',
            'query' => "SELECT
                            `lastName` AS `client last name`,
                            `firstName` AS `client first name`
                        FROM 
                            `clients` 
                        WHERE
                            `lastName` LIKE 'M%'
                        ORDER BY 
                            `firstName` ASC;"
        ],
        'Part1 ex6' => [
            'config' => 'colyseum',
            'query' => "SELECT
                            `title` AS `show`,
                            `performer` AS `by`,
                            `date` AS `on`,
                            `startTime` AS `at`
                        FROM 
                            `shows`
                        ORDER BY 
                            `title` ASC;"
        ],
        'Part1 ex7' => [
            'config' => 'colyseum',
            'query' => "SELECT
                            `id`,
                            `lastName` AS `last name`,
                            `firstName` AS `first name`,
                            `birthDate` AS `date of birth`,
                        IF(`card`=1, 'YES', 'NO') AS `has a card ?`,
                            `cardNumber` AS `card number`
                        FROM 
                            `clients` 
                        ORDER BY 
                            `id` ASC;"
        ],
        'Part2 ex1' => [
            'config' => 'patients',
            'query' => "SELECT
                            COUNT(*) AS `number of patients`
                        FROM 
                            `patients`;"
        ],
    ];

    // echo '<pre>' . var_export(json_encode($exercises), true) . '</pre>';
    $exercise = $_GET['query'] ?? ($_POST['query'] ?? array_key_first($exercises));

    // echo '<pre>'.var_export(array_key_first($exercises), true).'</pre>';


    if (!isset($_SESSION[$exercise])) {
        $db_configs = new DBConfig('.env');
        $model = new HelloPdoModel($db_configs, $exercises);
        $result =  $model->runExercise($exercise);
    } else {
        $result = $_SESSION[$exercise];
    }

    if (isset($result)) {
        $_SESSION[$exercise] = $result;
        $_SESSION['query'] = $exercises[$exercise]['query'];
    }
    require 'src/pdo-table.php';
    ?>

    <?php require 'src/globals-dump.php'; ?>

</body>

</html>

<?php
//------------------------------------------------------ close db connection
// $statement = null;
// $db = null;
