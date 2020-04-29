<?php

declare(strict_types=1);

/**
 * 
 */
?>

<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']);?>" method="GET">
    <label for="query">Query</label>
    <select name="query" onchange="this.form.submit()">
        <option value="ex1">Part 1 Exercise 1</option>
        <option value="ex2">Part 1 Exercise 2</option>
        <option value="ex3">Part 1 Exercise 3</option>
        <option value="ex4">Part 1 Exercise 4</option>
        <option value="ex5">Part 1 Exercise 5</option>
        <option value="ex6">Part 1 Exercise 6</option>
        <option value="ex7">Part 1 Exercise 7</option>
        <option value="ex2_1">Part 2 Exercise 1</option>
    </select>
    <!-- <input type="submit" value="GET !" /> -->
</form>
<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
    <textarea rows="20" style="width:100%;" name="query">...
    </textarea>
    <input type="submit" value="SUBMIT !" />
</form>
<?php
require_once 'src/utilities.php';

// echo '<pre>'.var_export($result, true).'</pre>';

if (is_null($result) || empty($result) || is_null($result[0])) {
    prettyDump([null]);
} else {
    prettyTable($result, 'query');
}