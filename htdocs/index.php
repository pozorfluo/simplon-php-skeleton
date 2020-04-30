<?php

/**
 * 
 */

declare(strict_types=1);

require_once 'src/AutoLoader.php';

use \Helpers\Dispatcher as Dispatcher;

// chdir(dirname(__FILE__));


//------------------------------------------------------------------ session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$page_title = 'index';

require 'src/head.php';
?>

<body>
    <?php require 'src/nav.php'; ?>

    <hr />
    <?php
    //-------------------------------------------------------------- redirection
    // echo getcwd() ."\n";
    // echo '<pre>'.var_export(__DIR__, true).'</pre>';
    // echo '<pre>'.var_export(__FILE__, true).'</pre>';
    // echo '<pre>'.var_export(dirname(__DIR__), true).'</pre>';
    // echo '<pre>'.var_export(dirname(__FILE__), true).'</pre>';
    // echo '<pre>'.var_export($_SERVER["SCRIPT_FILENAME"], true).'</pre>';
    // echo '<pre>'.var_export($_SERVER["SCRIPT_NAME"], true).'</pre>';
    $dispatcher = new Dispatcher();
    $dispatcher->call();
    ?>
    <?php require 'src/footer.php'; ?>

</body>

</html>