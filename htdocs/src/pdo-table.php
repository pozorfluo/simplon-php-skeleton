<?php

declare(strict_types=1);

/**
 * 
 */
?>

<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET">
    <label for="query">Query</label>
    <select name="query" onchange="this.form.submit()">
        <option>Select exercise</option>
        <?php
        foreach (array_keys($exercises) as $exercise) {
            echo '<option value="' . $exercise . '">' . $exercise . '</option>';
        }
        ?>
    </select>
    <!-- <input type="submit" value="GET !" /> -->
</form>

<?php
require_once 'src/Utilities.php';

// echo '<pre>'.var_export($result, true).'</pre>';

if (!isset($result) || is_null($result) || empty($result) || is_null($result[0])) {
    prettyDump([null]);
} else {
    prettyTable($result, 'query');
}
?>

<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <textarea rows="5" name="query"><?php 
        if(isset($_GET['query'])){
           echo $_SESSION['query'];
        }else{
            echo '...';
        }
    ?>
    </textarea>
    <input type="submit" value="SUBMIT !" />
</form>