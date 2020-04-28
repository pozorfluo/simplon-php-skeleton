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

    $db_configs = new DBConfig('.env');
    $model = new HelloPdoModel($db_configs);
    $exercise = $_POST['query'] ?? 'ex1';

    switch ($exercise) {
        case 'ex1':
            $result = $_SESSION[$exercise] ?? $model->getEx1();
            break;
        case 'ex2':
            $result = $_SESSION[$exercise] ?? $model->getEx2();
            break;
        case 'ex3':
            $result = $_SESSION[$exercise] ?? $model->getEx3();
            break;
        case 'ex4':
            $result = $_SESSION[$exercise] ?? $model->getEx4();
            break;
        case 'ex5':
            $result = $_SESSION[$exercise] ?? $model->getEx5();
            break;
        case 'ex6':
            $result = $_SESSION[$exercise] ?? $model->getEx6();
            break;
        case 'ex7':
            $result = $_SESSION[$exercise] ?? $model->getEx7();
            break;
        default:
            $result = $_SESSION[$exercise] ?? $model->getEx1();
            break;
    }

    if (isset($result)) {
        $_SESSION[$exercise] = $result;
    }
    require 'src/pdo-table.php';
    ?>

    <?php require 'src/globals-dump.php' ?>

</body>

</html>

<?php
//------------------------------------------------------ close db connection
// $statement = null;
// $db = null;
