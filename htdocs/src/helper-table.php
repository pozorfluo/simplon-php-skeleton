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

$helpers = [
    'Show Tables' => [
        'config' => 'patients',
        'query' => "SHOW TABLES;"
    ],
    'Show Columns from patients' => [
        'config' => 'patients',
        'query' => "SHOW COLUMNS FROM `patients`;"
    ],
    'Show Columns from appointments' => [
        'config' => 'patients',
        'query' => "SHOW COLUMNS FROM `appointments`;"
    ],
    'Part2 ex1 count' => [
        'config' => 'patients',
        'query' => "SELECT
                        COUNT(*) AS `number of patients`
                    FROM 
                        `patients`;"
    ],
    'Part2 ex1 get' => [
        'config' => 'patients',
        'query' => "SELECT
                        *
                    FROM 
                        `patients`;"
    ],
    'Part2 ex1 insert random test entry' => [
        'config' => 'patients',
        'query' => "INSERT INTO 
                        `patients` (`lastname`, `firstname`, `birthdate`, `phone`, `mail`)
                    VALUES
                        (?, ?, ?, ?, ?)
                        ;",
        'args' => [
            'lastname_' . substr(md5(strval(rand())), 0, 7),
            'firstname_' . substr(md5(strval(rand())), 0, 7),
            date('Y-m-d'),
            date('is-U'), // used as test phone
            substr(md5(strval(rand())), 0, 7) . '@mail.com',
        ]
    ],
    'Part2 ex1 empty table' => [
        'config' => 'patients',
        'query' => "DELETE FROM `patients`",
    ],
];

$helper = $_GET['query'] ?? array_key_first($helpers);

$db_configs = new DBConfig('.env');
$model = new HelloPdoModel($db_configs, $helpers);

$result =  $model->execute(
    $helpers[$helper]['config'],
    $helpers[$helper]['query'],
    $helpers[$helper]['args'] ?? NULL,
    true
);
?>
<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET">
    <label for="query">Query</label>
    <select name="query" onchange="this.form.submit()">
        <option>Select helper</option>
        <?php
        foreach (array_keys($helpers) as $helper) {
            echo '<option value="' . $helper . '">' . $helper . '</option>';
        }
        ?>
    </select>
    <!-- <input type="submit" value="GET !" /> -->
</form>

<?php
require_once 'src/Utilities.php';
// echo '<pre>'.var_export($result, true).'</pre>';

if (!isset($result) || is_null($result) || empty($result) || is_null($result[0])) {
    prettyDump(['All done !']);
} else {
    prettyTable($result, 'query');
}