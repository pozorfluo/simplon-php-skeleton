<?php

/**
 * 
 */

declare(strict_types=1);

// require_once 'src/AutoLoader.php';

use \Helpers\DBConfig as DBConfig;
use \Models\HelloPdo as HelloPdoModel;
use \Views\PatientForm as PatientForm;

//-------------------------------------------------------------- redirection
if (!isset($_GET['id'])) {
    header('Location: list-patient.php');
}
//------------------------------------------------------------------ session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$page_title = 'profile-patient';

require 'src/head.php';
?>

<body>
    <?php require 'src/nav.php'; ?>

    <hr />

    <?php
    //--------------------------------------------------------- retrieve profile

    $db_configs = new DBConfig('.env');
    $model = new HelloPdoModel($db_configs);

    $query = [
        'config' => 'patients',
        'query' =>
        'SELECT
            `lastname`, `firstname`, `birthdate`, `phone`, `mail`
        FROM
            `patients`
        WHERE
        `id` =' . intval($_GET['id']),
    ];

    $result =  $model->execute(
        $query['config'],
        $query['query']
    );

    $add_patient_form = new PatientForm(
        $result[0]['lastname'],
        $result[0]['firstname'],
        $result[0]['birthdate'],
        $result[0]['phone'],
        $result[0]['mail'],
        // htmlspecialchars($_SERVER['PHP_SELF'] .'?id='. $_GET['id']),
        'update-patient.php?id='. $_GET['id'],
        'Update Patient'
    );
    $add_patient_form->render();
    
    ?>
    <?php require 'src/footer.php'; ?>

</body>

</html>