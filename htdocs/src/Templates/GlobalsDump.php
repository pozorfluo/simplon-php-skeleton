<?php

/**
 * 
 */

declare(strict_types=1);


?>
<hr />
<form action="" method="POST">
    <input type="submit" name="killsession" value="Kill Session" />
</form>
<form action="" method="POST">
    <input type="submit" name="clearcache" value="Clear Cache" />
</form>


<?php
if (isset($_POST['killsession'])) {
    $_SESSION = [];
    if (session_status() === PHP_SESSION_ACTIVE) {
        session_destroy();
    }
}

if (isset($_POST['clearcache'])) {
    $dispatcher->clearCache();
}
// toss sensitive stuff before dumping $GLOBALS
// unset($db_config);


// hello opcache
$op_cache_status = opcache_get_status();
$loaded_extensions = get_loaded_extensions();

prettyDump($GLOBALS);
echo '<hr />';
echo "<pre>running     : {$_SERVER['HTTP_USER_AGENT']}</pre>";
echo "<pre>user ip     : {$_SERVER['REMOTE_ADDR']}</pre>";
echo "<pre>server name : {$_SERVER['SERVER_NAME']}</pre>";
// echo '<pre>'.var_export($GLOBALS, TRUE).'</pre>';
// phpinfo();
