<?php

/**
 * 
 */

declare(strict_types=1);

require_once 'src/AutoLoader.php';

use \Helpers\DBConfig as DBConfig;
use \Models\HelloPdo as HelloPdoModel;
use \Views\PatientForm as PatientForm;

//------------------------------------------------------------------ session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$page_title = 'add-patient';

require 'src/head.php';
?>

<body>
    <?php require 'src/nav.php'; ?>

    <hr />

    <?php

    $required_fields = [
        'lastname', 'firstname', 'birthdate', 'phone', 'mail'
    ];

    $missing_fields = array_filter($required_fields, function ($field) {
        return !(isset($_POST[$field]) &&  ($_POST[$field] !== ""));
    });


    if (empty($missing_fields)) {

        $args = array_map(function ($field) {
            return $_POST[$field];
        }, $required_fields);

        $query = [
            'config' => 'patients',
            'query' =>
            "INSERT INTO 
            `patients` (`lastname`, `firstname`, `birthdate`, `phone`, `mail`)
        VALUES
            (?, ?, ?, ?, ?)
            ;",
            'args' => $args
        ];

        $db_configs = new DBConfig('.env');
        $model = new HelloPdoModel($db_configs);

        $result =  $model->execute(
            $query['config'],
            $query['query'],
            $query['args'],
            true
        );
    }

    $add_patient_form = new PatientForm(
        'D'.str_shuffle('ubois') . ' de la M' . str_shuffle('oquette'),
        'Jean-Mi'.str_shuffle('michelou'),
        date('Y-m-d'),
        strval(rand(1111111111, 9999999999)),
        'jean-mi' . strval(rand(11, 999)) . '@caramail.com',
        htmlspecialchars($_SERVER['PHP_SELF'])
    );
    $add_patient_form->compose();
    ?>

    <?php require 'src/footer.php'; ?>

</body>

</html>