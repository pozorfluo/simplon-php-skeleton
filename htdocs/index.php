<?php

/**
 * Setup
 * Retrieve configuration
 * Run the app !
 * 
 * note
 *   This is is the main entry point
 * 
 * todo
 *   - [x] Redirect to parameterized index.php
 *   - [x] Use Dispatcher to call Controller/Action/Param
 *   - [x] Use Controller to request, filter, hand over Model data
 *   - [x] Use View to compose model data over layout, template
 *     + [x] Inline css, js when rendering layout, templates
 *   - [x] Plug in Model
 *     + [ ] Use Validatable interface to check Entity going in and out
 *   - [x] Use a configuration file
 *     + [x] Define a named constant to force config update
 *   - [x] Implement a simple file cache
 *     + [ ] Allow for Controller, Model, View to invalidate cached files
 *     + [ ] Handle getting hammered with requests that resolve to a valid
 *           Controller but end up swamping the cache because of distinct
 *           query strings filled with junk parameters
 *     + [ ] Handle requests resolving to super long file name more gracefully
 *     + [x] Check if all characters allowed in a query string are valid in
 *           a filename
 *       - [ ] Consider a rewrite rule or some validation
 *     + [x] Use the configured components as controller white list
 *     + [x] Use existing controller methods as an action white list
 *   - [x] Consider supporting Deferred components that are rendered via Js 
 *         hooks and placeholders after all regular components are fist pushed 
 *         and painted.
 *   - [x] Consider Deferred components via Js/Ajax
 *   - [ ] Test run Templates using and rendering other Templates
 *   - [ ] Add a project specific QueryString builder to simplify link creation
 *   - [ ] Write the test suite Entity->isValid(), validate() deserves
 * 
 *   - [x] Create minichat database
 *     + [x] Create messages table
 *     + [x] Create users table
 *     + [x] Link messages and users tables
 *     + [x] Add minichat db configuration to .env
 *   - [x] Rough an API for Minichat
 *     + [x] Extend Controller with a base API abstract class
 *     + [x] Flesh out a Minichat API extenting base API
 *     + [ ] Add the companion Model extending DBPDO
 *     + [ ] Test by looking at status response / json output
 *   - [ ] Rough a Minichat View
 *     + [ ] Add a deferred component to display Minichat message
 *     + [ ] Use Ajax in that component to poll Minichat API periodically
 *       - [ ] Keep it 'lazy'
 *       - [ ] Use something like setTimeout in promise resolution instead of
 *             setInterval in order not to hammer the API
 *   - [ ] Consider adding a cache layer between the Minichat API and the 
 *         model/DB
 *     + [ ] Use something like cached json
 *     + [ ] Update/Serve cached json
 *     + [ ] Batch updates to the DB
 *   - [ ] Investigate CORS issue with font preloading   
 */

declare(strict_types=1);

define('ROOT', __DIR__ . '/');
define('DEV_FORCE_CONFIG_UPDATE', true);
define('DEV_GLOBALS_DUMP', true);

require ROOT . 'src/Helpers/AutoLoader.php';

use Helpers\Dispatcher;
use Entities\Entity;
use Helpers\Cache;
use Helpers\CacheItem;
//--------------------------------------------------------------- playground

$cache = new Cache('helloCache');
$cache = new Cache('helloCache');
echo '<pre>'.var_export($cache, true).'</pre><hr />';
echo '<pre>'.var_export(Cache::listCaches(), true).'</pre><hr />';
exit;


echo is_file($file = 'index.php');
echo $file;

echo time() . '<br/>';
echo gettype(time()) . '<br/>';
// echo uniqid('', true);
// (time() - self::CACHE_TTL) > filemtime($cache_ttl_path)

$distribution_factor = 1;
$render_time = 0.004;
$log_odd = log(mt_rand() / mt_getrandmax());
echo time() - $render_time * $distribution_factor * $log_odd;
exit;
//------------------------------------------------------------------ session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    /* generate a CRSF guard token */
    if (empty($_SESSION['token'])) {
        $_SESSION['token'] = bin2hex(random_bytes(32));
    }

    /**
     * note
     *   Add an hidden input in forms :
     * 
     *     <input type="hidden" name="token" value="{$_SESSION['token']} />
     * 
     *   Verify token :
     * 
     *     if (!empty($_POST['token'])) {
     *         if (hash_equals($_SESSION['token'], $_POST['token'])){
     *             // good to go
     *         } else {
     *             // something might be up
     *         }
     *     }
     *   
     * 
     *   Use per form :
     *     
     *     hash_hmac('sha256', '/form.php', $_SESSION['another_token']);
     * 
     *     ( see available crypto algos with hash_hmac_algos() )
     */
}
//------------------------------------------------------------------- config
/**
 * Get list of registered components, database configs, etc... from config file
 * or provide/build some defaults
 */
$t = microtime(true);

$config_path = ROOT . '.env';
$config_exists = is_file($config_path);


if ($config_exists) {
    $config = json_decode(file_get_contents($config_path), true);
}

if (!isset($config['components']) || DEV_FORCE_CONFIG_UPDATE) {
    $src_dir = new RecursiveDirectoryIterator(ROOT . 'src/');
    $iterator = new RecursiveIteratorIterator($src_dir);
    $php_files = new RegexIterator(
        $iterator,
        '/^.+\.php$/i',
        RecursiveRegexIterator::GET_MATCH
    );

    /* reset for DEV_FORCE_CONFIG_UPDATE */
    $config['components'] = [];

    foreach ($php_files as $php_file) {
        /* do NOT register abstract classes or interfaces */
        $is_interface_or_abstract = preg_match(
            '/abstract class\s.+\n\{|interface\s.+\n\{/',
            file_get_contents($php_file[0])
        );

        if (!$is_interface_or_abstract) {
            $component = array_slice(explode('/', $php_file[0]), -2);
            $config['components'][$component[0]][] = substr($component[1], 0, -4);
        }
    }
    $config_exists = false;
    // echo 'components config missing ! Defaults emitted. <br />';
}
if (!isset($config['db_configs'])) {
    $config['db_configs'] = [
        'default' => [
            'DB_DRIVER' => 'mysql',
            'DB_HOST' => '127.0.0.1',
            'DB_PORT' => '3306',
            'DB_NAME' => 'default',
            'DB_CHARSET' => 'utf8mb4',
            'DB_USER' => null,
            'DB_PASSWORD' => null,
        ]
    ];
    $config_exists = false;
    // echo 'db_configs config missing ! Defaults emitted.<br />';
}

$time_spent['config'] = (microtime(true) - $t);

//--------------------------------------------------------------- playground
// use Entities\Patient;

// $test_entity = new Patient(
//     '10', //strval(rand(0, 9999)).
//     'D' . str_shuffle('ubois') . ' de la M' . str_shuffle('oquette'),
//     'Jdean-Mi' . str_shuffle('michelou'),
//     date('Y-m-d'). 'xdf',
//     strval(rand(1111111111, 9999999999)).'f',
//     'jean-mi' . strval(rand(11, 999)) . '@@caramail.com'
// );


// echo '<pre>'.var_export($test_entity->isValid(), true).'</pre><hr />';
// echo '<pre>'.var_export($test_entity->getData(), true).'</pre><hr />';
// echo '<pre>'.var_export($test_entity->getDefinitions(), true).'</pre><hr />';
// echo '<pre>'.var_export($test_entity->getFiltered(), true).'</pre><hr />';
// echo '<pre>'.var_export($test_entity->validate()->getData(), true).'</pre><hr />';


//---------------------------------------------------------------------- run
$t = microtime(true);

date_default_timezone_set('Europe/Paris');

$dispatcher = new Dispatcher($config);
$dispatcher->route()->cache();

$time_spent['serving_page'] = (microtime(true) - $t);
//------------------------------------------------------------------- config
/**
 * Serialize config to file if needed once the page is served 
 */
$t = microtime(true);

if (!$config_exists) {
    $config_file = fopen($config_path, 'w');
    fwrite($config_file, json_encode($config));
    fclose($config_file);
}

$time_spent['serialize_config'] = (microtime(true) - $t);


//-------------------------------------------------------------------- debug
$t = microtime(true);

if (!in_array('Content-Type: application/json', headers_list())) {
    require ROOT . 'src/Helpers/Utilities.php';
    require ROOT . 'src/Templates/GlobalsDump.php';

    $time_spent['display_debug'] = (microtime(true) - $t);
    $time_spent['total'] = array_sum($time_spent);

    echo "<pre>config           : {$time_spent['config']}</pre>";
    echo "<pre>serving_page     : {$time_spent['serving_page']}</pre>";
    echo "<pre>serialize_config : {$time_spent['serialize_config']}</pre>";
    echo "<pre>display_debug    : {$time_spent['display_debug']}</pre>";
    echo "<pre>total            : {$time_spent['total']}</pre>";
}
