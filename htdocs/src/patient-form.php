<?php

declare(strict_types=1);

/**
 * 
 */
?>

<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <label for="query">Query</label>
    <select name="query">
        <option>Select exercise</option>
        <?php
        foreach (array_keys($exercises) as $exercise) {
            echo '<option value="' . $exercise . '">' . $exercise . '</option>';
        }
        ?>
    </select>
    <input type="submit" value="POST !" />
</form>
