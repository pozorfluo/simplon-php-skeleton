<?php

declare(strict_types=1);
require_once 'utilities.php';

//------------------------------------------------------------------ session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$page_title = 'hello-pdo';

require 'html-head.php';
?>

<body>
    <?php
    require 'html-nav.php';
    ?>

    <hr />

    <?php
    //--------------------------------------------------- open db connection
    $db_user = $_ENV['MYSQL_BACKUP_USER'];
    $db_pass = $_ENV['MYSQL_ROOT_PASSWORD'];

    $db_options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_PERSISTENT => true
    );

    try {
        $db = new PDO(
            'mysql:host=127.0.0.1;dbname=colyseum;charset=utf8',
            $db_user,
            $db_pass,
            $db_options
        );
    } catch (PDOException $exception) {
        echo 'PDO Error : ' . $exception->getMessage() . '<br/>';
        // die();
    }

    //---------------------------------------------------- use db connection
    $query =
        "SELECT
             `id`,
             `lastName`,
             `firstName`,
             `birthDate`,
             `card`,
             `cardNumber`
         FROM 
             `clients` 
         ORDER BY 
             `lastName` DESC;";

    $statement = $db->query($query);

    $result = $statement->fetchAll();

    prettyTable($result, 'query');

    ?>


    <?php require 'globals-dump.php' ?>

</body>

</html>

<?php
//------------------------------------------------------ close db connection
// $statement = null;
// $db = null;
