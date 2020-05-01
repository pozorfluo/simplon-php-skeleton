<?php

/**
 * todo
 *   - [x] Redirect to parameterized index.php
 *   - [x] Use Dispatch to call Controller/Action/Param
 *   - [x] Use Controller to request, filter, hand over Model data
 *   - [x] Use View to compose model data over layout, template
 *     + [x] Inline css, js when rendering layout, templates
 *   - [ ] Plug in Model
 *     + [ ] Use Validatable interface to check Entity going in and out
 *   - [ ] Implement a simple file cache
 */

declare(strict_types=1);

define('ROOT', __DIR__ . '/');

require ROOT.'src/Helpers/AutoLoader.php';
require ROOT.'src/Utilities.php';

use Helpers\Dispatcher as Dispatcher;
use Controllers\Homepage;

//------------------------------------------------------------------ session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// echo '<pre>'.var_export(ROOT, true).'</pre>';
// echo '<pre>'.var_export(getcwd() , true).'</pre>';
// echo '<pre>'.var_export(__DIR__ , true).'</pre>';

$dispatcher = new Dispatcher();
$dispatcher->load()->call();

require ROOT.'src/Templates/GlobalsDump.php';
