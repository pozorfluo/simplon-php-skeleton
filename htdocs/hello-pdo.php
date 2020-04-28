<?php

declare(strict_types=1);
require_once 'src/AutoLoader.php';

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

    require 'src/DB-config.php';

    $helloPdoModel = new HelloPdoModel($db);

    switch ($_POST['query'] ?? 'ex1') {
        case 'ex1':
            $result = $_SESSION['helloPdo_getEx1'] ?? $helloPdoModel->getEx1();
            $_SESSION['helloPdo_getEx1'] = $result;
            break;
        case 'ex2':
            $result = $_SESSION['helloPdo_getEx2'] ?? $helloPdoModel->getEx2();
            $_SESSION['helloPdo_getEx2'] = $result;
            break;
        case 'ex3':
            $result = $_SESSION['helloPdo_getEx3'] ?? $helloPdoModel->getEx3();
            $_SESSION['helloPdo_getEx3'] = $result;
            break;
        case 'ex4':
            $result = $_SESSION['helloPdo_getEx4'] ?? $helloPdoModel->getEx4();
            $_SESSION['helloPdo_getEx4'] = $result;
            break;
        case 'ex5':
            $result = $_SESSION['helloPdo_getEx5'] ?? $helloPdoModel->getEx5();
            $_SESSION['helloPdo_getEx5'] = $result;
            break;
        case 'ex6':
            $result = $_SESSION['helloPdo_getEx6'] ?? $helloPdoModel->getEx6();
            $_SESSION['helloPdo_getEx6'] = $result;
            break;
        case 'ex7':
            $result = $_SESSION['helloPdo_getEx7'] ?? $helloPdoModel->getEx7();
            $_SESSION['helloPdo_getEx7'] = $result;
            break;
        default:
            $result = $_SESSION['helloPdo_getEx1'] ?? $helloPdoModel->getEx1();
            $_SESSION['helloPdo_getEx1'] = $result;
            break;
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
