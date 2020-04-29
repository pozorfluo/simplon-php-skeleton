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
    <?php
    require 'src/nav.php';
    ?>

    <hr />

    <?php

    $exercise = $_GET['query'] ?? $_POST['query'] ?? 'nothing';
    echo '<pre>'.var_export($exercise, true).'</pre>';
    

    if (!isset($_SESSION[$exercise])) {
        $db_configs = new DBConfig('.env');
        $model = new HelloPdoModel($db_configs);
        switch ($exercise) {
            case 'ex1':
                $result =  $model->getEx1();
                break;
            case 'ex2':
                $result =  $model->getEx2();
                break;
            case 'ex3':
                $result =  $model->getEx3();
                break;
            case 'ex4':
                $result = $model->getEx4();
                break;
            case 'ex5':
                $result =  $model->getEx5();
                break;
            case 'ex6':
                $result = $model->getEx6();
                break;
            case 'ex7':
                $result =  $model->getEx7();
                break;
            case 'ex2_1':
                $result = $model->getEx2_1();
                break;
            default:
                $result = [null];
                break;
        }
    } else {
        echo 'else result';
        $result = $_SESSION[$exercise];
    }

    // if (isset($result)) {
    //     $_SESSION[$exercise] = $result;
    // }
    require 'src/pdo-table.php';
    ?>

    <?php require 'src/globals-dump.php' ?>

</body>

</html>

<?php
//------------------------------------------------------ close db connection
// $statement = null;
// $db = null;
