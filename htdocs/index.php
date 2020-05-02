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
// $dispatcher->load()->call();
// (new Dispatcher())->call();
$dispatcher->call()->cache();

// // Test Source
// function Test8_1()
// {
//     global $x;
//     #$someClass =& new SomeClass2();

//     /* The Test */
//     $t = microtime(true);
//     $i = 0;
//     while ($i < 1000000) {
//         $for_true = empty($_SERVER['QUERY_STRING']);
//         ++$i;
//     }

//     return (microtime(true) - $t);
// }

// // Test Source
// function Test8_2()
// {
//     global $aHash;
//     #$someClass =& new SomeClass2();

//     /* The Test */
//     $t = microtime(true);
//     $i = 0;
//     while ($i < 1000000) {
//         $for_true = $_SERVER['QUERY_STRING'] === '';
//         ++$i;
//     }

//     return (microtime(true) - $t);
// }

// echo '<pre>' . var_export(Test8_2(), true) . '</pre>';
// echo '<pre>' . var_export(Test8_2(), true) . '</pre>';
// echo '<pre>' . var_export(Test8_2(), true) . '</pre>';
// echo '<pre>' . var_export(Test8_2(), true) . '</pre>';
// echo '<pre>' . var_export(Test8_2(), true) . '</pre>';
// echo '<pre>' . var_export(Test8_2(), true) . '</pre>';
// echo '<pre>' . var_export(Test8_2(), true) . '</pre>';
// echo '<pre>' . var_export(Test8_2(), true) . '</pre>';
// echo '<pre>' . var_export(Test8_2(), true) . '</pre>';
// echo '<pre>' . var_export(Test8_2(), true) . '</pre>';
// echo '--<br />';
// echo '<pre>' . var_export(Test8_1(), true) . '</pre>';
// echo '<pre>' . var_export(Test8_1(), true) . '</pre>';
// echo '<pre>' . var_export(Test8_1(), true) . '</pre>';
// echo '<pre>' . var_export(Test8_1(), true) . '</pre>';
// echo '<pre>' . var_export(Test8_1(), true) . '</pre>';
// echo '<pre>' . var_export(Test8_1(), true) . '</pre>';
// echo '<pre>' . var_export(Test8_1(), true) . '</pre>';
// echo '<pre>' . var_export(Test8_1(), true) . '</pre>';
// echo '<pre>' . var_export(Test8_1(), true) . '</pre>';
// echo '<pre>' . var_export(Test8_1(), true) . '</pre>';


require ROOT . 'src/Templates/GlobalsDump.php';
