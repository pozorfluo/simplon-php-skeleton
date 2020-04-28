<?php

declare(strict_types=1);


//------------------------------------------------------------------ session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$page_title = 'hello-pdo';

require 'src/html-head.php';
?>

<body>
    <?php
    require 'src/html-nav.php';
    ?>

    <hr />

    <?php

    require 'src/DB-config.php';
    require 'src/DB.php';
    $db = new DB(
        $db_config['DB_DRIVER'],
        $db_config['DB_HOST'],
        $db_config['DB_PORT'],
        $db_config['DB_NAME'],
        $db_config['DB_CHARSET'],
        $db_config['DB_USER'],
        $db_config['DB_PASSWORD']
    );

    require 'src/HelloPdoModel.php';
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
