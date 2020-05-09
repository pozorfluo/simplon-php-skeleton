<?php
// Initial Configuration
global $aHash;
$iterations = 1000;
$i   = 0;
$tmp = '';
while ($i < $iterations) {
    $aHash[] = substr(
        str_shuffle('abcdefghijklmnopqrstuvxyz'),
        random_int(0, 8),
        16
    ) . '.php';
    $aHash[] = 'index.php';
    ++$i;
}

unset($i, $tmp);

// Test Source
function Test1_0()
{
    global $aHash;

    /* The Test */
    $t = microtime(true);
    reset($aHash);
    foreach ($aHash as $file) {
        $out = file_exists($file);
    };

    echo '<pre>' . var_export($out, true) . '</pre>';
    return (microtime(true) - $t);
}
// Test Source
function Test1_1()
{
    global $aHash;

    /* The Test */
    $t = microtime(true);
    reset($aHash);
    foreach ($aHash as $file) {
        $out = file_exists($file);
        clearstatcache();
    };

    echo '<pre>' . var_export($out, true) . '</pre>';
    return (microtime(true) - $t);
}
function Test1_2()
{
    global $aHash;

    /* The Test */
    $t = microtime(true);
    reset($aHash);
    foreach ($aHash as $file) {
        $out = is_file($file);
    };

    echo '<pre>' . var_export($out, true) . '</pre>';
    return (microtime(true) - $t);
}

function Test1_3()
{
    global $aHash;

    /* The Test */
    $t = microtime(true);
    reset($aHash);
    foreach ($aHash as $file) {
        $out = is_file($file);
        clearstatcache();
    };

    echo '<pre>' . var_export($out, true) . '</pre>';
    return (microtime(true) - $t);
}

function Test1_4()
{
    global $aHash;

    /* The Test */
    $t = microtime(true);
    reset($aHash);
    foreach ($aHash as $file) {
        $out = stream_resolve_include_path($file);
    };

    echo '<pre>' . var_export($out, true) . '</pre>';
    return (microtime(true) - $t);
}

function Test1_5()
{
    global $aHash;

    /* The Test */
    $t = microtime(true);
    reset($aHash);
    foreach ($aHash as $file) {
        $out = stream_resolve_include_path($file);
        clearstatcache();
    };

    echo '<pre>' . var_export($out, true) . '</pre>';
    return (microtime(true) - $t);
}



echo $iterations . ' iterations of file_exists() : ';
echo '<pre>' . var_export(Test1_0(), true) . '</pre>';
echo $iterations . ' iterations of file_exists(), clearstatcache() : ';
echo '<pre>' . var_export(Test1_1(), true) . '</pre>';
echo $iterations . ' iterations of is_file() : ';
echo '<pre>' . var_export(Test1_2(), true) . '</pre>';
echo $iterations . ' iterations of is_file(), clearstatcache() : ';
echo '<pre>' . var_export(Test1_3(), true) . '</pre>';
echo $iterations . ' iterations of stream_resolve_include_path() : ';
echo '<pre>' . var_export(Test1_4(), true) . '</pre>';
echo $iterations . ' iterations of stream_resolve_include_path(), clearstatcache() : ';
echo '<pre>' . var_export(Test1_5(), true) . '</pre>';