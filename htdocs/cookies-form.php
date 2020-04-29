<?php

declare(strict_types=1);

//------------------------------------------------------------------ session
if (session_status() === PHP_SESSION_NONE) {
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
        htmlspecialchars($_POST['username'], ENT_QUOTES),
        time() + 60 * 5,
        "/",
        "",
        false,
        true
    );
    setcookie(
        'dontstorepasswordincookies',
        htmlspecialchars($_POST['dontstorepasswordincookies'], ENT_QUOTES),
        time() + 60 * 5,
        "/",
        "",
        false,
        true
    );
}


$page_title = 'cookies-form';

 require 'src/head.php';
?>

<body>
    <?php require 'src/nav.php'; ?>

    <hr />
    <form action="" method="POST">
        Not Your Login 😭
        <input type="text" name="username" value="" />
        Not Your Password 😖
        <input type="password" name="dontstorepasswordincookies" value="" />
        <input type="submit" value="DO NOT STORE SENSITIVE INFO IN COOKIES 🥺" />
    </form>

    <?php  require 'src/globals-dump.php' ?>
</body>

</html>