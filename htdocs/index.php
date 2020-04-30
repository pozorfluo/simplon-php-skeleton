<?php

/**
 * todo
 *   - [x] Redirect to parameterized index.php
 *   - [x] Use Dispatch to call Controller/Action/Param
 *   - [x] Use Controller to request, filter, hand over Model data
 *   - [ ] Use View to compose model data over layout, template
 *     + [ ] Inline css, js when rendering layout, templates
 */

declare(strict_types=1);

require 'src/Helpers/AutoLoader.php';
require 'src/Utilities.php';

use \Helpers\Dispatcher as Dispatcher;


//------------------------------------------------------------------ session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$dispatcher = new Dispatcher();
$dispatcher->call();
