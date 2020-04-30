<?php

/**
 * 
 */

declare(strict_types=1);
require_once 'src/AutoLoader.php';

use \Helpers\DBConfig as DBConfig;
use \Models\HelloPdo as HelloPdoModel;

//------------------------------------------------------------------ session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$page_title = 'list-patient';

require 'src/head.php';
?>

<body>
    <?php require 'src/nav.php'; ?>

    <hr />

    <?php require 'src/patient-table.php'; ?>

    <?php require 'src/footer.php'; ?>

</body>

</html>