<?php
//--------------------------------------------------------------- playground

$iterations = 10000;
$i   = 0;
$values = [];
$collisions = 0;
while ($i < $iterations) {

    $hopefully_unique = uniqid('', true);
    if (in_array($hopefully_unique, $values)) {
        $collisions++;
    }else
    {
        $values[] = $hopefully_unique;
    }
    ++$i;
}
echo 'collisions :'. $collisions.'<br/>';
echo '//--------------------------------------------------------------<br />';
$t = microtime(true);
$i   = 0;
while ($i < $iterations) {

    $a = uniqid();
    ++$i;
}
echo $a.'<br/>';
echo '<pre>' . var_export('uniqid() :' . (microtime(true) - $t), true) . '</pre>';
echo '//--------------------------------------------------------------<br />';
$t = microtime(true);
$i   = 0;
while ($i < $iterations) {

    $a = uniqid('', true);
    ++$i;
}
echo $a.'<br/>';
echo '<pre>' . var_export('uniqid() more_entropy :' . (microtime(true) - $t), true) . '</pre>';
echo '//--------------------------------------------------------------<br />';
$t = microtime(true);
$i   = 0;
while ($i < $iterations) {

    $a = md5(uniqid((string)mt_rand(), true).microtime(true));
    ++$i;
}
echo $a.'<br/>';
echo '<pre>' . var_export('md5(uniqid(mt_rand(), true).microtime(true)) :' . (microtime(true) - $t), true) . '</pre>';
echo '//--------------------------------------------------------------<br />';
$t = microtime(true);
$i   = 0;
while ($i < $iterations) {

    $a = hash('fnv1a64', (string)microtime(true));
    ++$i;
}
echo $a.'<br/>';
echo '<pre>' . var_export('hash(\'fnv1a64\', microtime(true)) :' . (microtime(true) - $t), true) . '</pre>';
echo '//--------------------------------------------------------------<br />';
$t = microtime(true);
$i   = 0;
while ($i < $iterations) {

    $a = hash('fnv1a64', 'fixed string');
    ++$i;
}
echo $a.'<br/>';
echo '<pre>' . var_export('hash(\'fnv1a64\', \'fixed string\') :' . (microtime(true) - $t), true) . '</pre>';
echo '//--------------------------------------------------------------<br />';
$t = microtime(true);
$i   = 0;
while ($i < $iterations) {

    $a = hash('fnv1a64', $i.'');
    ++$i;
}
echo $a.'<br/>';
echo '<pre>' . var_export('hash(\'fnv1a64\',  $i.\'\') :' . (microtime(true) - $t), true) . '</pre>';
echo '//--------------------------------------------------------------<br />';
$t = microtime(true);
$i   = 0;
while ($i < $iterations) {

    $a = hash('fnv1a64', $i.'') . microtime(true);
    ++$i;
}
echo $a.'<br/>';
echo '<pre>' . var_export('hash(\'fnv1a64\',  $i.\'\') :' . (microtime(true) - $t), true) . '</pre>';
echo '//--------------------------------------------------------------<br />';
$t = microtime(true);
$i   = 0;
while ($i < $iterations) {

    $a = bin2hex(random_bytes(32));
    ++$i;
}
echo $a.'<br/>';
echo '<pre>' . var_export('bin2hex(random_bytes(32))' . (microtime(true) - $t), true) . '</pre>';
echo '//--------------------------------------------------------------<br />';
$t = microtime(true);
$i   = 0;
while ($i < $iterations) {

    $a = microtime(true).bin2hex(random_bytes(16));
    ++$i;
}
echo $a.'<br/>';
echo '<pre>' . var_export('microtime(true).bin2hex(random_bytes(16)):' . (microtime(true) - $t), true) . '</pre>';
echo '//--------------------------------------------------------------<br />';
$t = microtime(true);
$i   = 0;
while ($i < $iterations) {

    $a = bin2hex(random_bytes(32));
    ++$i;
}
echo $a.'<br/>';
echo '<pre>' . var_export('32 random_bytes:' . (microtime(true) - $t), true) . '</pre>';
// echo bin2hex(random_bytes(32));
// echo microtime(true).bin2hex(random_bytes(16));
// echo microtime(true);

$iterations = 100000;

$t = microtime(true);
$i   = 0;
$values = [];
$collisions = 0;
while ($i < $iterations) {

    $hopefully_unique = uniqid('', true);
    // if (in_array($hopefully_unique, $values)) {
    if (isset($values[$hopefully_unique])) {
        $collisions++;
    }else
    {
        $values[$hopefully_unique] = 1;
    }
    ++$i;
}
echo 'collisions :'. $collisions.'<br/>';
// echo '<pre>'.var_export($values, true).'</pre><hr />';
echo '<pre>' . var_export('uniqid(\'\', true) :' . (microtime(true) - $t), true) . '</pre>';
echo '//--------------------------------------------------------------<br />';
$t = microtime(true);
$i   = 0;
$values = [];
$collisions = 0;
while ($i < $iterations) {

    $hopefully_unique = hash('fnv1a64', 'controller%3DHome'.$i.'.5.html');
    // if (in_array($hopefully_unique, $values)) {
    if (isset($values[$hopefully_unique])) {
        $collisions++;
    }else
    {
        $values[$hopefully_unique] = 1;
    }
    ++$i;
}
echo 'collisions :'. $collisions.'<br/>';
// echo '<pre>'.var_export($values, true).'</pre><hr />';
echo '<pre>' . var_export('uniqid(\'\', true) :' . (microtime(true) - $t), true) . '</pre>';
echo '//--------------------------------------------------------------<br />';
$t = microtime(true);
$i   = 0;
$values = [];
$collisions = 0;
while ($i < $iterations) {

    $hopefully_unique = hash('sha256', 'controller%3DHome'.$i.'.5.html');
    // if (in_array($hopefully_unique, $values)) {
    if (isset($values[$hopefully_unique])) {
        $collisions++;
    }else
    {
        $values[$hopefully_unique] = 1;
    }
    ++$i;
}
echo 'collisions :'. $collisions.'<br/>';
// echo '<pre>'.var_export($values, true).'</pre><hr />';
echo '<pre>' . var_export('uniqid(\'\', true) :' . (microtime(true) - $t), true) . '</pre>';
echo '//--------------------------------------------------------------<br />';


$iterations = 1000;

$t = microtime(true);
$i   = 0;
$values = [];
$collisions = 0;
while ($i < $iterations) {

    $hopefully_unique = uniqid('', true);
    // if (in_array($hopefully_unique, $values)) {
    if (isset(array_flip(array_column($values, "filename"))[$hopefully_unique])) {
        $collisions++;
    } else {
        $values[$i] = ['filename' => $hopefully_unique];
    }
    ++$i;
}
echo 'collisions :' . $collisions . '<br/>';
// echo '<pre>'.var_export(array_flip(array_column($values, "filename"))[$hopefully_unique]).'</pre><hr />';
// echo '<pre>'.var_export(array_flip(array_column($values, "filename"))).'</pre><hr />';

echo '<pre>' . var_export('isset(array_flip(array_column($values, "filename"))[$hopefully_unique]) : ' . (microtime(true) - $t), true) . '</pre>';
echo '//--------------------------------------------------------------<br />';
$t = microtime(true);
$i   = 0;
$values = [];
$collisions = 0;
while ($i < $iterations) {

    $hopefully_unique = uniqid('', true);
    // if (in_array($hopefully_unique, $values)) {
    if (isset(array_column($values, "filename", "filename")[$hopefully_unique])) {
        $collisions++;
    } else {
        $values['key_name' . $i] = [
            'filename' => '5eb62a757a56e0.61116934.html',
            'tags' => ['tagA', 'tagB'],
            'popularity' => 5,
            'render_time' => 0.0010299682617188
        ];
    }
    ++$i;
}
echo 'collisions :' . $collisions . '<br/>';
// echo '<pre>'.var_export(array_flip(array_column($values, "filename"))[$hopefully_unique]).'</pre><hr />';
// echo '<pre>'.var_export(array_column($values, "filename", "filename")).'</pre><br/>';

echo '<pre>' . var_export('isset(array_column($values, "filename", "filename")[$hopefully_unique]) : ' . (microtime(true) - $t), true) . '</pre>';
echo '//--------------------------------------------------------------<br />';
$t = microtime(true);
$i   = 0;
$values = [];
$collisions = 0;
while ($i < $iterations) {

    $hopefully_unique = uniqid('', true);
    if (in_array($hopefully_unique, $values)) {
        $collisions++;
    } else {
        $values[$i] = ['filename' => $hopefully_unique];
    }
    ++$i;
}
echo 'collisions :' . $collisions . '<br/>';
// echo '<pre>'.var_export(array_flip(array_column($values, "filename"))[$hopefully_unique]).'</pre><hr />';
// echo '<pre>'.var_export(in_array($hopefully_unique, array_column($values, "filename"))).'</pre><br />';

echo '<pre>' . var_export('in_array($hopefully_unique, $values)) : ' . (microtime(true) - $t), true) . '</pre>';
echo '//--------------------------------------------------------------<br />';
$t = microtime(true);
$i   = 0;
$values = [];
$collisions = 0;
while ($i < $iterations) {

    $hopefully_unique = uniqid('', true);
    // if (in_array($hopefully_unique, $values)) {
    if (isset($values[$hopefully_unique])) {
        $collisions++;
    } else {
        $values[$hopefully_unique] = 1;
    }
    ++$i;
}
echo 'collisions :' . $collisions . '<br/>';
// echo '<pre>'.var_export($values, true).'</pre><hr />';
echo '<pre>' . var_export('isset($values[$hopefully_unique]): ' . (microtime(true) - $t), true) . '</pre>';
echo '//--------------------------------------------------------------<br />';
$t = microtime(true);
$i   = 0;
$values = [];
$collisions = 0;
while ($i < $iterations) {

    $hopefully_unique = uniqid('', true);
    if (in_array($hopefully_unique, $values)) {
        $collisions++;
    } else {
        $values[] = $hopefully_unique;
    }
    ++$i;
}
echo 'collisions :' . $collisions . '<br/>';
echo '<pre>' . var_export(in_array($hopefully_unique, $values), true) . '</pre><br />';
echo '<pre>' . var_export('in_array($hopefully_unique, $values): ' . (microtime(true) - $t), true) . '</pre>';
echo '//--------------------------------------------------------------<br />';


$iterations = 10000;

echo '//--------------------------------------------------------------<br />';
$t = microtime(true);
$i   = 0;
$values = [];
$collisions = 0;
while ($i < $iterations) {

    $hopefully_unique = uniqid('', true);
    // if (in_array($hopefully_unique, $values)) {
    if (isset(array_column($values, "filename", "filename")[$hopefully_unique])) {
        $collisions++;
    } else {
        $values['key_name' . $i] = [
            'filename' => $hopefully_unique,
            'tags' => ['tagA', 'tagB'],
            'popularity' => 5,
            'render_time' => 0.0010299682617188
        ];
    }
    ++$i;
}
echo 'collisions :' . $collisions . '<br/>';
// echo '<pre>'.var_export(array_column($values, "filename", "filename")).'</pre><br/>';
echo '<pre>' . var_export('isset(array_column($values, "filename", "filename")[$hopefully_unique]) : ' . (microtime(true) - $t), true) . '</pre>';
echo '//--------------------------------------------------------------<br />';
$t = microtime(true);
$i   = 0;
$values = [];
$collisions = 0;
while ($i < $iterations) {

    $hopefully_unique = uniqid('', true);
    if (isset(array_flip(array_column($values, "filename"))[$hopefully_unique])) {
        $collisions++;
    } else {
        $values['key_name' . $i] = [
            'filename' => $hopefully_unique,
            'tags' => ['tagA', 'tagB'],
            'popularity' => 5,
            'render_time' => 0.0010299682617188
        ];
    }
    ++$i;
}
echo 'collisions :' . $collisions . '<br/>';
// echo '<pre>'.var_export(array_flip(array_column($values, "filename"))[$hopefully_unique]).'</pre><hr />';
// echo '<pre>'.var_export(array_column($values, "filename", "filename")).'</pre><br/>';

echo '<pre>' . var_export('isset(array_flip(array_column($values, "filename"))[$hopefully_unique]) : ' . (microtime(true) - $t), true) . '</pre>';
echo '//--------------------------------------------------------------<br />';

$t = microtime(true);
$i   = 0;
$values = [];
$collisions = 0;
while ($i < $iterations) {

    $hopefully_unique = uniqid('', true);
    // if (in_array($hopefully_unique, $values)) {
    if (isset($values[$hopefully_unique])) {
        $collisions++;
    } else {
        $values[$hopefully_unique] = 1;
    }
    ++$i;
}
echo 'collisions :' . $collisions . '<br/>';
// echo '<pre>'.var_export($values, true).'</pre><hr />';
echo '<pre>' . var_export('baseline isset($values[$hopefully_unique]): ' . (microtime(true) - $t), true) . '</pre>';
echo '//--------------------------------------------------------------<br />';