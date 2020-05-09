<?php
//--------------------------------------------------------------- playground
$iterations = 100;

$i   = 0;
$trove = [];
$collisions = 0;
while ($i < $iterations) {

    $trove['key_name' . $i] = new CacheItem(uniqid('', true), 0.0012, time() + 30);
    // touch(ROOT . 'cache/' . 'key_name' . $i . '.' . uniqid('', true) . '.00012.' . (time() + 30) . '.html');
    ++$i;
}

// echo '<pre>'.var_export($trove, true).'</pre><hr />';

$serialized_cached_item = serialize($trove);
$unserialized_cached_item = unserialize($serialized_cached_item);
// echo '<pre>'.var_export($cached_item, true).'</pre><hr />';
// echo '<pre>'.var_export($serialized_cached_item, true).'</pre><hr />';
// echo '<pre>'.var_export($unserialized_cached_item, true).'</pre><hr />';
echo '<pre>' . var_export($unserialized_cached_item == $trove, true) . '</pre><hr />';

$serialized_cached_item = json_encode($trove);
$unserialized_cached_item = json_decode($serialized_cached_item);
// echo '<pre>'.var_export($cached_item, true).'</pre><hr />';
// echo '<pre>'.var_export($serialized_cached_item, true).'</pre><hr />';
// echo '<pre>'.var_export($unserialized_cached_item, true).'</pre><hr />';
echo '<pre>' . var_export($unserialized_cached_item == $trove, true) . '</pre><hr />';

// $cached_item = new CacheItem(uniqid('', true), 0.0012, time() + 30);
// $serialized_cached_item = json_encode($cached_item);
// $unserialized_cached_item = CacheItem::fromJson(json_decode($serialized_cached_item, true));
// echo '<pre>'.var_export($cached_item, true).'</pre><hr />';
// echo '<pre>'.var_export($serialized_cached_item, true).'</pre><hr />';
// echo '<pre>'.var_export($unserialized_cached_item, true).'</pre><hr />';
// echo '<pre>'.var_export($unserialized_cached_item == $cached_item).'</pre><hr />';

// $cache_dir_content = scandir(ROOT . 'cache/');
// echo '<pre>' . var_export($cache_dir_content, true) . '</pre><hr />';

// $cache_dir = new DirectoryIterator(ROOT . 'cache/');
// foreach ($cache_dir as $cache_item) {
//     if (!$cache_item->isDot()) {
//         $cache_meta = explode('.', $cache_item->getPathname());
//         $scanned_trove[$cache_meta[0]] = array_slice($cache_meta, 1);
//     }
// }

// echo '<pre>' . var_export($scanned_trove, true) . '</pre><hr />';

$iterations = 1000;
echo '//--------------------------------------------------------------<br />';
$t = microtime(true);
$i   = 0;
$collisions = 0;
while ($i < $iterations) {

    $cache_dir_content = scandir(ROOT . 'cache/');
    ++$i;
}
echo '<pre>' . var_export('scandir : ' . (microtime(true) - $t), true) . '</pre>';
echo '//--------------------------------------------------------------<br />';
$t = microtime(true);
$i   = 0;
$collisions = 0;
while ($i < $iterations) {

    $cache_dir_content = scandir(ROOT . 'cache/');
    foreach ($cache_dir_content as $cache_item) {
        $cache_meta = explode('.', $cache_item);
        $scanned_trove[$cache_meta[0]] = $cache_meta;
    }
    ++$i;
}
// echo '<pre>' . var_export($scanned_trove, true) . '</pre><hr />';
echo '<pre>' . var_export('scandir explode : ' . (microtime(true) - $t), true) . '</pre>';
echo '//--------------------------------------------------------------<br />';
$t = microtime(true);
$i   = 0;
$collisions = 0;
while ($i < $iterations) {

    $cache_dir = new DirectoryIterator(ROOT . 'cache/');
    foreach ($cache_dir as $cache_item) {
        if (!$cache_item->isDot()) {
            $cache_meta = explode('.', $cache_item->getPathname());
            $scanned_trove[$cache_meta[0]] = array_slice($cache_meta, 1);
        }
    }
    ++$i;
}
echo '<pre>' . var_export('DirectoryIterator : ' . (microtime(true) - $t), true) . '</pre>';
echo '//--------------------------------------------------------------<br />';
$t = microtime(true);
$i   = 0;
$collisions = 0;
while ($i < $iterations) {

    $cache_dir = new DirectoryIterator(ROOT . 'cache/');
    foreach ($cache_dir as $cache_item) {
        if (!$cache_item->isDot()) {
            $cache_meta = explode('.', $cache_item->getPathname());
            $scanned_trove[$cache_meta[0]] = $cache_meta;
        }
    }
    ++$i;
}
echo '<pre>' . var_export('DirectoryIterator NoSlice: ' . (microtime(true) - $t), true) . '</pre>';
echo '//--------------------------------------------------------------<br />';
$t = microtime(true);
$i   = 0;
$collisions = 0;
while ($i < $iterations) {

    $serialized_cached_item = serialize($trove);
    $unserialized_cached_item = unserialize($serialized_cached_item);
    ++$i;
}
echo '<pre>' . var_export('serialize : ' . (microtime(true) - $t), true) . '</pre>';
echo '//--------------------------------------------------------------<br />';
$t = microtime(true);
$i   = 0;
$collisions = 0;
while ($i < $iterations) {

    $serialized_cached_item = json_encode($trove);
    $unserialized_cached_item = json_decode($serialized_cached_item);
    ++$i;
}
echo '<pre>' . var_export('json_encode : ' . (microtime(true) - $t), true) . '</pre>';
echo '//--------------------------------------------------------------<br />';