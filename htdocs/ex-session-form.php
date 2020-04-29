<?php

declare(strict_types=1);
require_once 'src/Utilities.php';

//------------------------------------------------------------------ session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$page_title = 'ex-session-form';
 require 'src/head.php';
?>

<body>


    <?php
     require 'src/nav.php';
    //---------------------------------------------------------------- p6ex1
    // if (isset($_GET['firstname'])) {
    //     $firstname = htmlspecialchars($_GET['firstname'], ENT_QUOTES);
    //     echo "<h1 class='header'>Hello {$firstname}!</h1>";
    // } else {
    //     $firstname = 'no first name ? 😔';
    // }

    // if (isset($_GET['lastname'])) {
    //     $lastname = htmlspecialchars($_GET['lastname'], ENT_QUOTES);
    // } else {
    //     $lastname = 'no last name ? 😔';
    // }

    // if (isset($_GET['age'])) {
    //     $age = (int) $_GET['age'];
    // } else {
    //     $age = 'no age ? 😔';
    // }

    // if (isset($_GET['startDate'])) {
    //     $startDate = htmlspecialchars($_GET['startDate'], ENT_QUOTES);
    // } else {
    //     $startDate = 'no startDate ? 😔';
    // }
    // if (isset($_GET['endDate'])) {
    //     $endDate = htmlspecialchars($_GET['endDate'], ENT_QUOTES);
    // } else {
    //     $endDate = 'no endDate ? 😔';
    // }

    // if (isset($_GET['language'])) {
    //     $language = htmlspecialchars($_GET['language'], ENT_QUOTES);
    // } else {
    //     $language = 'no language ? 😔';
    // }

    // if (isset($_GET['server'])) {
    //     $server = htmlspecialchars($_GET['server'], ENT_QUOTES);
    // } else {
    //     $server = 'no server ? 😔';
    // }

    // if (isset($_GET['week'])) {
    //     $week = htmlspecialchars($_GET['week'], ENT_QUOTES);
    // } else {
    //     $week = 'no week ? 😔';
    // }
    // <h3>{$startDate}</h3>
    // <h3>{$endDate}</h3>
    // <h4>{$language}</h4>
    // <h4>{$server}</h4>
    // <h4>{$week}</h4>
    //------------------------------------------------------------------- p7
    $required_fields = [
        'firstname', 'lastname', 'gender'
    ];

    $missing_post_fields = array_filter($required_fields, function ($field) {
        return !(isset($_POST[$field]) &&  ($_POST[$field] !== ""));
    });

    $missing_file = !(isset($_FILES['userfile'])
        && ($_FILES['userfile']['error'] === 0)
        && ($_FILES['userfile']['type'] === 'application/pdf'));

    if ($missing_file) {
        $missing_post_fields[] = 'userfile';
    }

    $missing_get_fields = array_filter($required_fields, function ($field) {
        return !(isset($_GET[$field]) &&  ($_GET[$field] !== ""));
    });


    if (!empty($missing_post_fields) && !empty($missing_get_fields)) {
        echo <<<FORM
    <hr />
    <form enctype="multipart/form-data" action="" method="POST">
        First Name 
        <input type="text" name="firstname" value="ケンシロウ" />
        Last Name
        <input type="text" name="lastname" value="霞" />
        Gender 
        <select name="gender" id="gender">
            <option > </option>
            <option value="female">female</option>
            <option value="male" selected>male</option>
            <option value="other">other</option>
        </select>

        <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
        Upload file
        <input name="userfile" type="file" />

        <input type="submit" value="POST !"/>
    </form>

        <hr />

    <form action="" method="GET">
        First Name 
        <input type="text" name="firstname" value="" />
        Last Name
        <input type="text" name="lastname" value="" />
        Gender 
        <select name="gender" id="gender">
            <option  selected> </option>
            <option value="female">female</option>
            <option value="male">male</option>
            <option value="other">other</option>
        </select>
        <input type="submit" value="GET !"/>
    </form>

FORM;
    } else {
        if (empty($missing_post_fields)) {
            $firstname = htmlspecialchars($_POST['firstname'], ENT_QUOTES);
            $lastname = htmlspecialchars($_POST['lastname'], ENT_QUOTES);
            $gender = htmlspecialchars($_POST['gender'], ENT_QUOTES);
            $filename = htmlspecialchars($_FILES['userfile']['name'], ENT_QUOTES);
        } else {
            $firstname = htmlspecialchars($_GET['firstname'], ENT_QUOTES);
            $lastname = htmlspecialchars($_GET['lastname'], ENT_QUOTES);
            $gender = htmlspecialchars($_GET['gender'], ENT_QUOTES);
            $filename = 'no file sent';
        }
        echo <<<HELLO
                <h1 class="header">{$firstname}</h1>
                <h2>hello {$firstname} {$lastname} !</h2>
                <h3>{$gender}</h3>
                <h2>{$filename}</h2>
HELLO;
        //------------------------------------------------------------ p8ex2
        $_SESSION['firstname'] = $firstname;
        $_SESSION['lastname'] = $lastname;
        $_SESSION['gender'] = $gender;
    }

    ?>
    <?php  require 'src/globals-dump.php' ?>
</body>

</html>