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
    if (isset($_GET['firstname'])) {
        $firstname = htmlspecialchars($_GET['firstname']);
        echo "<h1 class='header'>Hello {$firstname}!</h1>";
    } else {
        $firstname = 'no first name ? 😔';
    }

    if (isset($_GET['lastname'])) {
        $lastname = htmlspecialchars($_GET['lastname']);
    } else {
        $lastname = 'no last name ? 😔';
    }

    if (isset($_GET['age'])) {
        $age = (int) $_GET['age'];
    } else {
        $age = 'no age ? 😔';
    }

    if (isset($_GET['startDate'])) {
        $startDate = $_GET['startDate'];
    } else {
        $startDate = 'no startDate ? 😔';
    }
    if (isset($_GET['endDate'])) {
        $endDate = $_GET['endDate'];
    } else {
        $endDate = 'no endDate ? 😔';
    }

    if (isset($_GET['language'])) {
        $language = $_GET['language'];
    } else {
        $language = 'no language ? 😔';
    }

    if (isset($_GET['server'])) {
        $server = $_GET['server'];
    } else {
        $server = 'no server ? 😔';
    }

    if (isset($_GET['week'])) {
        $week = $_GET['week'];
    } else {
        $week = 'no week ? 😔';
    }

    echo <<<HELLO
    <h2>{$firstname}</h2>
    <h2>{$lastname}</h2>
    <h3>{$age}</h3>
    <h3>{$startDate}</h3>
    <h3>{$endDate}</h3>
    <h4>{$language}</h4>
    <h4>{$server}</h4>
    <h4>{$week}</h4>
HELLO;

echo <<<FORM
<hr />
<form action="index.php" method="post">

        First Name <input type="text" name="firstname" value="{$firstname}" />
        Last Name <input type="text" name="lastname" value="{$lastname}" />
    Age <input type="number" name="age" value={$age} />
       Gender <select name="gender" id="gender">
        <option value="female">female</option>
        <option value="male" selected>male</option>
        <option value="other">other</option>
    </select>
    <input type="submit" value="GO !"/>
</form>
FORM;
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