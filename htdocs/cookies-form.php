<?php

declare(strict_types=1);
require 'utilities.php';

//------------------------------------------------------------------ session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//------------------------------------------------------------------ cookies
$required_fields = [
    'username', 'dontstorepasswordincookies'
];

$missing_post_fields = array_filter($required_fields, function ($field) {
    return !(isset($_POST[$field]) &&  ($_POST[$field] !== ""));
});

if (empty($missing_post_fields)) {
    setcookie(
        'username',
        $_POST['username'],
        time() + 60 * 5,
        "/",
        "",
        false,
        true
    );
    setcookie(
        'dontstorepasswordincookies',
        $_POST['dontstorepasswordincookies'],
        time() + 60 * 5,
        "/",
        "",
        false,
        true
    );
}


$page_title = 'cookies-form';

require 'html-head.php';
?>

<body>
    <?php
    require 'html-nav.php';
    ?>

    <hr />
    <form action="" method="POST">
        Not Your Login 😭
        <input type="text" name="username" value="" />
        Not Your Password 😖
        <input type="password" name="dontstorepasswordincookies" value="" />
        <input type="submit" value="DO NOT STORE SENSIBLE INFO IN COOKIES 🥺" />
    </form>

    <?php
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