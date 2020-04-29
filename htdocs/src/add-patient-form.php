<?php

declare(strict_types=1);

require_once 'src/AutoLoader.php';

use \Helpers\DBConfig as DBConfig;
use \Models\HelloPdo as HelloPdoModel;

/**
 * 
 */
?>
<?php

$required_fields = [
    'lastname', 'firstname', 'birthdate', 'phone', 'mail'
];

$missing_fields = array_filter($required_fields, function ($field) {
    return !(isset($_POST[$field]) &&  ($_POST[$field] !== ""));
});


if (empty($missing_fields)) {

    $args = array_filter($required_fields, function ($field) {
        return $_POST[$field];
    });

    echo '<pre>' . var_export($args, true) . '</pre>';
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

    // $result =  $model->execute(
    //     $query['config'],
    //     $query['query'],
    //     $query['args'],
    //     true
    // );
}
?>
<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <label for="lastname">Last Name</label>
    <input type="text" name="lastname" value="D<?= str_shuffle('ubois') . ' de la M' . str_shuffle('oquette')  ?>" required />

    <label for="firstname">First Name</label>
    <input type="text" name="firstname" value="Jean-Mi<?= str_shuffle('michelou') ?>" required />

    <label for="birthdate">Birth Date</label>
    <input type="date" name="birthdate" value="<?= date('Y-m-d') ?>" required />

    <label for="phone">Phone (10 digits)</label>
    <input type="tel" name="phone" pattern="[0-9]{10}" value="<?= strval(rand(1111111111, 9999999999)) ?>" required />

    <label for="mail">E-mail</label>
    <input type="email" name="mail" value="<?= 'jean-mi' . strval(rand(11, 999)) . '@caramail.com' ?>" required />

    <input type="submit" value="Add Patient" />
</form>