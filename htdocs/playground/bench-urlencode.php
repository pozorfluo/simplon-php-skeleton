<?php

$iterations = 100000;
$t = microtime(true);
$i   = 0;
while ($i < $iterations) {
    $base_name = $_SERVER['QUERY_STRING'];
    ++$i;
}
echo '<pre>' . var_export('baseline :' . (microtime(true) - $t), true) . '</pre>';
echo $base_name . '<br/>';



$t = microtime(true);
$i   = 0;
while ($i < $iterations) {
    $base_name = htmlspecialchars($_SERVER['QUERY_STRING']);
    ++$i;
}
echo '<pre>' . var_export('htmlspecialchars :' . (microtime(true) - $t), true) . '</pre>';
echo $base_name . '<br/>';

$t = microtime(true);
$i   = 0;
while ($i < $iterations) {
    $base_name = htmlentities($_SERVER['QUERY_STRING']);
    ++$i;
}
echo '<pre>' . var_export('htmlentities :' . (microtime(true) - $t), true) . '</pre>';
echo $base_name . '<br/>';

$base_name = 'reset';
$t = microtime(true);
$i   = 0;
while ($i < $iterations) {
    $base_name = filter_var(
        $_SERVER['QUERY_STRING'],
        FILTER_VALIDATE_REGEXP,
        ['options' => ['regexp' => '([A-Za-z0-9_\-\s]+)']]
    );
    ++$i;
}
echo '<pre>' . var_export('FILTER_VALIDATE_REGEXP :' . (microtime(true) - $t), true) . '</pre>';
echo $base_name . '<br/>';

$t = microtime(true);
$i   = 0;
while ($i < $iterations) {
    $base_name = filter_var($_SERVER['QUERY_STRING'], FILTER_SANITIZE_ENCODED);
    ++$i;
}
echo '<pre>' . var_export('FILTER_SANITIZE_ENCODED :' . (microtime(true) - $t), true) . '</pre>';
echo $base_name . '<br/>';

$t = microtime(true);
$i   = 0;
while ($i < $iterations) {
    $base_name = http_build_query($this->request);
    ++$i;
}
echo '<pre>' . var_export('http_build_query :' . (microtime(true) - $t), true) . '</pre>';
echo $base_name . '<br/>';


$t = microtime(true);
$i   = 0;
while ($i < $iterations) {
    $base_name = urlencode($_SERVER['QUERY_STRING']);
    ++$i;
}
echo '<pre>' . var_export('urlencode :' . (microtime(true) - $t), true) . '</pre>';
echo $base_name . '<br/>';

$t = microtime(true);
$i   = 0;
while ($i < $iterations) {
    $base_name = rawurlencode($_SERVER['QUERY_STRING']);
    ++$i;
}
echo '<pre>' . var_export('rawurlencode  :' . (microtime(true) - $t), true) . '</pre>';
echo $base_name . '<br/>';
