<?php

declare(strict_types=1);
require 'utilities.php';

//------------------------------------------------------------------ session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// var_dump(defined('SID'));
// var_dump(SID);
// print_r($_SESSION);
// echo session_id();

$page_title = 'another-page';


require 'html-head.php';
?>

<body>
    <?php
    require 'html-nav.php';

    if (empty($_SESSION['count'])){
        $_SESSION['count'] = 1;
    } else {
        $_SESSION['count']++;
    }

    if (isset($_SESSION['firstname'])) {
    echo '<h1 class="header">'.$_SESSION['firstname'].'</h1>';
    }

    if (isset($_SESSION['lastname'])) {
    echo '<h2>'.$_SESSION['lastname'].'</h2>';
    }
    
    if (isset($_SESSION['gender'])) {
    echo '<h3>'.$_SESSION['gender'].'</h3>';
    }

    echo "<h3>page seen {$_SESSION['count']} times.</h3>";
    echo '<h2>SID : '.htmlspecialchars(session_id()).'</h2>';

    echo '<hr />';
    echo '<h2>$GLOBALS</h2>';
    dumpArray($GLOBALS);

    echo '<hr />';
    echo "<pre>running     : {$_SERVER['HTTP_USER_AGENT']}</pre>";
    echo "<pre>user ip     : {$_SERVER['REMOTE_ADDR']}</pre>";
    echo "<pre>server name : {$_SERVER['SERVER_NAME']}</pre>";
    // echo '<pre>'.var_export($GLOBALS, TRUE).'</pre>';
    ?>
</body>

</html>