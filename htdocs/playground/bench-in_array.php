<?php

$iterations = 1000000;
echo '//--------------------------------------------------------------<br />';
$t = microtime(true);
$i   = 0;
while ($i < $iterations) {
    if ((!isset($this->request['controller'])
        || (!in_array($this->request['controller'], $config['components']['Controllers'])))) {
        $a = $i;
    }
    ++$i;
}
echo '<pre>' . var_export('in_array :' . (microtime(true) - $t), true) . '</pre>';
echo '//--------------------------------------------------------------<br />';
$t = microtime(true);
$i   = 0;
while ($i < $iterations) {
    if ((!isset($this->request['controller'])
        || (!in_array($this->request['controller'], $config['components']['Controllers'], true)))) {
        $a = $i;
    }
    ++$i;
}
echo '<pre>' . var_export('in_array strict :' . (microtime(true) - $t), true) . '</pre>';
echo '//--------------------------------------------------------------<br />';
$t = microtime(true);
$i   = 0;
while ($i < $iterations) {
    if ((!isset($this->request['controller'])
        || (!array_search($this->request['controller'], $config['components']['Controllers'])))) {
        $a = $i;
    }

    ++$i;
}
echo '<pre>' . var_export('array_search :' . (microtime(true) - $t), true) . '</pre>';
echo '//--------------------------------------------------------------<br />';
$t = microtime(true);
$i   = 0;
while ($i < $iterations) {
    if ((!isset($this->request['controller'])
        || (!array_search($this->request['controller'], $config['components']['Controllers'], true)))) {
        $a = $i;
    }

    ++$i;
}
echo '<pre>' . var_export('array_search strict:' . (microtime(true) - $t), true) . '</pre>';
echo '//--------------------------------------------------------------<br />';
$t = microtime(true);
$i   = 0;
while ($i < $iterations) {
    if ((!isset($this->request['controller'])
        || (!array_key_exists($this->request['controller'], array_flip($config['components']['Controllers']))))) {
        $a = $i;
    }

    ++$i;
}
echo '<pre>' . var_export('array_flip :' . (microtime(true) - $t), true) . '</pre>';