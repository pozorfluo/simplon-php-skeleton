<?php

declare(strict_types=1);


//------------------------------------------------------------------ session
if (session_status() == PHP_SESSION_NONE) {
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
    //--------------------------------------------------- open db connection
    $db_config = file_get_contents('.env');
    $db_config = json_decode($db_config, true);

    $db_dsn = $db_config['DB_DRIVER']
        . ':host=' . $db_config['DB_HOST']
        . ':' . $db_config['DB_PORT']
        . ';dbname=' . $db_config['DB_NAME']
        . ';charset=' . $db_config['DB_CHARSET'];

    $db_options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_PERSISTENT => true
    );

    try {
        $db = new PDO(
            $db_dsn,
            $db_config['DB_USER'],
            $db_config['DB_PASSWORD'],
            $db_options
        );
    } catch (PDOException $exception) {
        echo 'PDO Error : ' . $exception->getMessage() . '<br/>';
        // die();
    }

    require 'src/HelloPdoModel.php';
    $helloPdoModel = new HelloPdoModel($db);
    switch ($_POST['query'] ?? 'ex1') {
        case 'ex1':
            $result = $helloPdoModel->getEx1();
            break;
        case 'ex2':
            $result = $helloPdoModel->getEx2();
            break;
        case 'ex3':
            $result = $helloPdoModel->getEx3();
            break;
        default:
            $result = $helloPdoModel->getEx1();
            break;
    }
    require 'src/pdo-table.php';


    // toss sensitive $db_config before dumping $GLOBALS
    unset($db_config);
    unset($db_dsn);
    ?>

    <?php require 'src/globals-dump.php' ?>

</body>

</html>

<?php
//------------------------------------------------------ close db connection
// $statement = null;
// $db = null;
