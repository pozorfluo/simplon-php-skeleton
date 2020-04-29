<?php

declare(strict_types=1);

/**
 * 
 */
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
