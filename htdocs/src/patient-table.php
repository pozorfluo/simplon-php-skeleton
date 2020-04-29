<?php

/**
 * 
 */

declare(strict_types=1);

require_once 'src/AutoLoader.php';

use \Helpers\DBConfig as DBConfig;
use \Models\HelloPdo as HelloPdoModel;

/**
 * 
 */
?>

<?php
require_once 'src/Utilities.php';

$query = [
    'config' => 'patients',
    'query' => "SELECT
                    *
                FROM 
                    `patients`;"
];

$db_configs = new DBConfig('.env');
$model = new HelloPdoModel($db_configs);

$results =  $model->execute(
    $query['config'],
    $query['query']
);

if (!isset($results) || is_null($results) || empty($results) || is_null($results[0])) {
    prettyDump(['Table empty']);
} else {
    $css_class = 'query';

    /* table header */
    $col_names = array_keys($results[0]);
    echo '<table class="' . $css_class . '"><thead class="' . $css_class . '">'
        . '<tr class="' . $css_class . '">';

    foreach ($col_names as $col_name) {
        echo '<th class="' . $css_class . '">' . $col_name . '</th>';
    }
    echo '</tr></thead><tbody>';

    /* table body */
    foreach ($results as $result) {
        echo '<tr class="' . $css_class . '">';
        foreach ($result as $col => $value) {
            echo '<td class="' . $css_class . '">'
                . '<a href=profile-patient.php?id=' . $result['id'] . '>'
                . $value . '</a></td>';
        }
        echo '</tr>';
    }
    echo '</tbody></table>';
}
