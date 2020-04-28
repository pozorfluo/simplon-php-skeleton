<?php

declare(strict_types=1);

/**
 * 
 */
?>
<form action="" method="post">
    <label for="query">Query</label>
    <select name="query">
        <option value="ex1">Exercise 1</option>
        <option value="ex2">Exercise 2</option>
        <option value="ex3">Exercise 3</option>
    </select>
    <input type="submit" value="GET !" />
</form>

<?php
require_once 'src/utilities.php';
prettyTable($result, 'query');
