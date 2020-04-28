<?php

declare(strict_types=1);

$db_config = file_get_contents('.env');
$db_config = json_decode($db_config, true);

$db = new DB(
    $db_config['DB_DRIVER'],
    $db_config['DB_HOST'],
    $db_config['DB_PORT'],
    $db_config['DB_NAME'],
    $db_config['DB_CHARSET'],
    $db_config['DB_USER'],
    $db_config['DB_PASSWORD']
);
