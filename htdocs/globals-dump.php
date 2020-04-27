<?php

declare(strict_types=1);
require_once 'utilities.php';

    echo '<hr />';
    echo '<h2>$GLOBALS</h2>';
    dumpArray($GLOBALS);

    echo '<hr />';
    echo "<pre>running     : {$_SERVER['HTTP_USER_AGENT']}</pre>";
    echo "<pre>user ip     : {$_SERVER['REMOTE_ADDR']}</pre>";
    echo "<pre>server name : {$_SERVER['SERVER_NAME']}</pre>";
    // echo '<pre>'.var_export($GLOBALS, TRUE).'</pre>';
