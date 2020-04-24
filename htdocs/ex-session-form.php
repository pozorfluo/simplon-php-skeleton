<?php

declare(strict_types=1);
require 'utilities.php';

$page_title = 'ex-session-form';
require 'html-head.php';
?>

<body>


    <?php
    require 'html-nav.php';
    //---------------------------------------------------------------- p6ex1
    // if (isset($_GET['firstname'])) {
    //     $firstname = htmlspecialchars($_GET['firstname']);
    //     echo "<h1 class='header'>Hello {$firstname}!</h1>";
    // } else {
    //     $firstname = 'no first name ? 😔';
    // }

    // if (isset($_GET['lastname'])) {
    //     $lastname = htmlspecialchars($_GET['lastname']);
    // } else {
    //     $lastname = 'no last name ? 😔';
    // }

    // if (isset($_GET['age'])) {
    //     $age = (int) $_GET['age'];
    // } else {
    //     $age = 'no age ? 😔';
    // }

    // if (isset($_GET['startDate'])) {
    //     $startDate = $_GET['startDate'];
    // } else {
    //     $startDate = 'no startDate ? 😔';
    // }
    // if (isset($_GET['endDate'])) {
    //     $endDate = $_GET['endDate'];
    // } else {
    //     $endDate = 'no endDate ? 😔';
    // }

    // if (isset($_GET['language'])) {
    //     $language = $_GET['language'];
    // } else {
    //     $language = 'no language ? 😔';
    // }

    // if (isset($_GET['server'])) {
    //     $server = $_GET['server'];
    // } else {
    //     $server = 'no server ? 😔';
    // }

    // if (isset($_GET['week'])) {
    //     $week = $_GET['week'];
    // } else {
    //     $week = 'no week ? 😔';
    // }
    // <h3>{$startDate}</h3>
    // <h3>{$endDate}</h3>
    // <h4>{$language}</h4>
    // <h4>{$server}</h4>
    // <h4>{$week}</h4>
    //---------------------------------------------------------------- p6ex6


    $required_fields = [
        'firstname', 'lastname', 'gender'
    ];

    $missing_post_fields = array_filter($required_fields, function ($field) {
        return !(isset($_POST[$field]) &&  ($_POST[$field] !== ""));
    });

    $missing_get_fields = array_filter($required_fields, function ($field) {
        return !(isset($_GET[$field]) &&  ($_GET[$field] !== ""));
    });

    if (!empty($missing_post_fields) && !empty($missing_get_fields)) {
        echo <<<FORM
    <hr />
    <form action="" method="post">
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
    <input type="submit" value="POST !"/>
    </form>
    <hr />
    <form action="" method="get">
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
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $gender = $_POST['gender'];
        } else {
            $firstname = $_GET['firstname'];
            $lastname = $_GET['lastname'];
            $gender = $_GET['gender'];
        }
        echo <<<HELLO
                <h1 class="header">{$firstname}</h1>
                <h2>hello {$firstname} {$lastname} !</h2>
                <h3>{$gender}</h3>
HELLO;
    }


    //     if (
    //         isset($_POST['firstname'], $_POST['lastname'], $_POST['gender'])
    //         && ($_POST['gender'] !== "")
    //         && ($_POST['firstname'] !== "")
    //         && ($_POST['lastname'] !== "")
    //     ) {
    //         $firstname = $_POST['firstname'];
    //         $lastname = $_POST['lastname'];
    //         $gender = $_POST['gender'];
    //     } else {
    //         if (
    //             isset($_GET['firstname'], $_GET['lastname'], $_GET['gender'])
    //             && ($_GET['gender'] !== "")
    //             && ($_GET['firstname'] !== "")
    //             && ($_GET['lastname'] !== "")
    //         ) {
    //             $firstname = $_GET['firstname'];
    //             $lastname = $_GET['lastname'];
    //             $gender = $_GET['gender'];
    //             echo <<<HELLO
    //             <h1 class="header>Hello {$firstname}</h1>
    //             <h2>{$lastname}</h2>
    //             <h3>{$gender}</h3>
    // HELLO;
    //         } else {

    //             echo <<<FORM
    //         <hr />
    //         <form action="" method="post">
    //         First Name 
    //         <input type="text" name="firstname" value="" />
    //         Last Name
    //         <input type="text" name="lastname" value="" />
    //         Gender 
    //         <select name="gender" id="gender">
    //         <option  selected> </option>
    //         <option value="female">female</option>
    //         <option value="male">male</option>
    //         <option value="other">other</option>
    //         </select>
    //         <input type="submit" value="GO !"/>
    //         </form>
    // FORM;
    //         }
    //     }
    //--
    echo '<hr />';
    echo '<h2>$GLOBALS</h2>';
    dumpArray($GLOBALS);


    echo '<hr />';
    echo "<pre>running : {$_SERVER['HTTP_USER_AGENT']}</pre>";
    // echo '<pre>'.var_export($GLOBALS, TRUE).'</pre>';
    ?>
</body>

</html>