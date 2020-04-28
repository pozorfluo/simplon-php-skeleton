<?php

declare(strict_types=1);

$db_config = file_get_contents('.env');
$db_config = json_decode($db_config, true);
