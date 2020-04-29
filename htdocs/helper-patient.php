<?php

/**
 * 
 */

declare(strict_types=1);

//------------------------------------------------------------------ session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$page_title = 'add-patient';

require 'src/head.php';
?>

<body>
    <?php require 'src/nav.php'; ?>

    <hr />

    <?php require 'src/helper-table.php'; ?>
    <?php require 'src/footer.php';?>

</body>

</html>