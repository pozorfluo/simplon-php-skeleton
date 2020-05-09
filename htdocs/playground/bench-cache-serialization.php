<?php
//--------------------------------------------------------------- playground
$cached_item = new CacheItem(uniqid('', true), 0.0012, time() + 30);
$serialized_cached_item = serialize($cached_item);
$unserialized_cached_item = unserialize($serialized_cached_item);
echo '<pre>'.var_export($cached_item, true).'</pre><hr />';
echo '<pre>'.var_export($serialized_cached_item, true).'</pre><hr />';
echo '<pre>'.var_export($unserialized_cached_item, true).'</pre><hr />';
echo '<pre>'.var_export($unserialized_cached_item == $cached_item).'</pre><hr />';

$cached_item = new CacheItem(uniqid('', true), 0.0012, time() + 30);
$serialized_cached_item = json_encode($cached_item);
$unserialized_cached_item = json_decode($serialized_cached_item);
echo '<pre>'.var_export($cached_item, true).'</pre><hr />';
echo '<pre>'.var_export($serialized_cached_item, true).'</pre><hr />';
echo '<pre>'.var_export($unserialized_cached_item, true).'</pre><hr />';
echo '<pre>'.var_export($unserialized_cached_item == $cached_item).'</pre><hr />';

// $cached_item = new CacheItem(uniqid('', true), 0.0012, time() + 30);
// $serialized_cached_item = json_encode($cached_item);
// $unserialized_cached_item = CacheItem::fromJson(json_decode($serialized_cached_item, true));
// echo '<pre>'.var_export($cached_item, true).'</pre><hr />';
// echo '<pre>'.var_export($serialized_cached_item, true).'</pre><hr />';
// echo '<pre>'.var_export($unserialized_cached_item, true).'</pre><hr />';
// echo '<pre>'.var_export($unserialized_cached_item == $cached_item).'</pre><hr />';


$iterations = 10000;

echo '//--------------------------------------------------------------<br />';
$t = microtime(true);
$i   = 0;
$collisions = 0;
while ($i < $iterations) {

    $cached_item = new CacheItem(uniqid('', true), 0.0012, time() + 30);
    $serialized_cached_item = serialize($cached_item);
    $unserialized_cached_item = unserialize($serialized_cached_item);
    ++$i;
}
echo '<pre>' . var_export('serialize : ' . (microtime(true) - $t), true) . '</pre>';
echo '//--------------------------------------------------------------<br />';
$t = microtime(true);
$i   = 0;
$collisions = 0;
while ($i < $iterations) {

    $cached_item = new CacheItem(uniqid('', true), 0.0012, time() + 30);
    $serialized_cached_item = json_encode($cached_item);
    $unserialized_cached_item = json_decode($serialized_cached_item);
    ++$i;
}
echo '<pre>' . var_export('json_decode : ' . (microtime(true) - $t), true) . '</pre>';
echo '//--------------------------------------------------------------<br />';
$t = microtime(true);
$i   = 0;
$collisions = 0;
while ($i < $iterations) {

    $cached_item = new CacheItem(uniqid('', true), 0.0012, time() + 30);
    $serialized_cached_item = json_encode($cached_item);
    $unserialized_cached_item = CacheItem::fromJson(json_decode($serialized_cached_item, true));
    ++$i;
}
echo '<pre>' . var_export('CacheItem::fromJson(json_decode($serialized_cached_item) : ' . (microtime(true) - $t), true) . '</pre>';
echo '//--------------------------------------------------------------<br />';