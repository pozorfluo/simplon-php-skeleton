<?php

declare(strict_types=1);

/**
 * 
 */
?>

<?php
require_once 'src/Utilities.php';
// echo '<pre>'.var_export($result, true).'</pre>';

if (!isset($result) || is_null($result) || empty($result) || is_null($result[0])) {
    prettyDump(['All done !']);
} else {
    prettyTable($result, 'query');
}
