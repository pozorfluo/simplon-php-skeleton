<?php

declare(strict_types=1);
require 'utilities.php';

$page_title = 'cookies-read';

require 'html-head.php';
?>

<body>
    <?php
    require 'html-nav.php';
    ?>


    <?php

    if (isset($_COOKIE['username'])) {
        echo '<h2>' . $_COOKIE['username'] . '</h2>';
    }

    if (isset($_COOKIE['dontstorepasswordincookies'])) {
        echo '<h3>' . $_COOKIE['dontstorepasswordincookies'] . '🥺😭😖</h3>';
    }


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