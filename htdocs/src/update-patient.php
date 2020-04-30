<?php

/**
 * 
 */

declare(strict_types=1);

require_once 'src/AutoLoader.php';

use \Helpers\DBConfig as DBConfig;
use \Models\HelloPdo as HelloPdoModel;
//-------------------------------------------------------------- redirection
if (!isset($_GET['id'])) {
    header('Location: list-patient.php');
}
//------------------------------------------------------------ submit update
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

    $args[] = $_GET['id'];

    $db_configs = new DBConfig('.env');
    $model = new HelloPdoModel($db_configs);

    $query = [
        'config' => 'patients',
        'query' =>
        "UPDATE 
            `patients`
        SET
            `lastname` = ?,
            `firstname` = ?,
            `birthdate` = ?,
            `phone` = ?,
            `mail` = ?
        WHERE
            `id` = ?;",
        'args' => $args
    ];

    $result =  $model->execute(
        $query['config'],
        $query['query'],
        $query['args'],
        true
    );
}
//-------------------------------------------------------------- redirection
header('Location: profile-patient.php?id=' . $_GET['id']);
