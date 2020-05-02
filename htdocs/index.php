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
 *   - [x] Implement a simple file cache
 *     + [ ] Allow for Controller, Model, View to invalidate cached files
 *     + [ ] Handle getting hammered with requests that resolve to a valid
 *           Controller but end up swamping the cache because of distinct
 *           query strings filled with junk parameters
 *     + [ ] Handle requests resolving to super long file name more gracefully
 *     + [x] Check if all characters allowed in a query string are valid in
 *           a filename
 *       - [ ] Consider a rewrite rule or some validation
 *   - [ ] Use a configuration file
 */

declare(strict_types=1);

define('ROOT', __DIR__ . '/');

require ROOT . 'src/Helpers/AutoLoader.php';
require ROOT . 'src/Utilities.php';

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
$dispatcher->call()->cache();

require ROOT . 'src/Templates/GlobalsDump.php';
