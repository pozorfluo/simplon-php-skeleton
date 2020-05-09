<?php

declare(strict_types=1);

namespace Helpers;

use Controllers\Controller;

/**
 * note
 *   If a cache file exists and is not past its expiration date, it is 
 *   considered valid and Dispatcher will serve it.
 */
class Cache
{
    /**
     * Path to root cache folder.
     *
     * @var string
     */
    const CACHE_PATH = ROOT . 'cache/';
        
    /**
     * Time To Live in seconds before an item in cache is considered stale.
     *
     * @var int
     */
    protected $ttl = 30;
        
    /**
     * Cache name.
     *
     * @var string
     */
    protected $name;

    /**
     * Path to this cache .ttl file.
     *
     * @var string
     */
    protected $ttl_path;

    /**
     * 
     * @var array 2-tuple
     */
    protected $prune_odds;

    /**
     * @var array [string $key, CacheItem $item]
     */
    protected $trove;
    
    /**
     * Create a new Cache instance.
     * 
     * @param integer $ttl
     * @param string $name

     * @return void
     */
    public function __construct(int $ttl, string $name)
    {
        parse_str($_SERVER['QUERY_STRING'], $this->request);

        /* sanitize */
        $base_name = rawurlencode($_SERVER['QUERY_STRING']);

        $this->request['cached_file'] =
            substr(self::CACHE_PATH . $base_name, 0, 250) . '.html';
    }

    /**
     * Determine if a valid cached version of the request exists.
     *
     * @return boolean
     */
    public function isCached(): bool
    {
        $file_path = $this->request['cached_file'];
        return is_file($file_path)
            && (time() - $this->ttl) < filemtime($file_path);
    }

    /**
     *  note
     *    Will erase content of cached file if used before route()
     *    Subsequent route() may serve that cached empty files
     */
    // public function cache(): self
    // {
    //     ($this->controller ?? $this->load())->cache();

    //     $cache_ttl_path = self::CACHE_PATH . 'cache.ttl';
    //     if (!is_file($cache_ttl_path)) {
    //         touch($cache_ttl_path);
    //     }
    //     $this->pruneCache();

    //     return $this;
    // }

    /**
     * Create cache.ttl ticker if it does NOT exist
     * If at least a ttl period has elapsed since last pruning
     *   Delete each cached files past ttl
     *   Reset ticker
     * 
     * todo
     *   - [ ] Implement probabilistic early expiration
     *   - [ ] Implement subsequent pre-emptive re-rendering
     *     + [ ] Throttle/delay pre-emptive re-rendering according to server 
     *           load
     *     + [ ] See https://www.php.net/manual/en/function.proc-nice.php
     * 
     * note
     *   The goal is to pre-emptively re-render often requested pages that have
     *   been rendered and cached once they expire or are invalidated.
     *  
     *   ~~Structure the cached file names as follow :~~
     *      ~~sanitized_query_string.popularity_counter.extension~~
     *      
     *   Where popularity_counter is an integer incremented each time that page
     *   is requested and decremented each time it is pre-emptively re-rendered.
     * 
     *   Use popularity_counter to tune the probability distribution of the 
     *   cache pruning lottery.
     * 
     *   Check if a request page exists in cache by populating an array of
     *   exploded filenames present in the cache folder and checking for the
     *   requested page existence in the [0] column.
     * 
     *   Alternatively, populate an array and write to cache.ttl on exit. This
     *   means that scanning directory is done when there's no rush.
     * 
     *   Solve the filename length problem by storing the query in json,
     *   assigning fixed length unique id to use a file name for each query.
     * 
     *   See file_put_contents($filename, $contents, LOCK_EX);
     * 
     *  e.g.
     * ,
     *    "controller%3DHome" : {
     *      "filename" : "5eb62a757a56e0.61116934.html",
     *      "tags" : ["tagA", "tagB"],
     *      "popularity" : 5,
     *      "render_time" : 0.0010299682617188
     *    },
     * 
     *  
     * 
     *   *__IMPORTANT__*
     *   All of this operations happens after the page as been served.
     * 
     * 
     * time() - $this->ttl) > filemtime($cache_ttl_path)
     * 
     *  function x-fetch(key, ttl, beta=1) {
     * value, delta, expiry ← cache_read(key)
     * if (!value || time() − delta * beta * log(rand(0,1)) ≥ expiry) {
     *   start ← time()
     *   value ← recompute_value()
     *   delta ← time() – start
     *   cache_write(key, (value, delta), ttl)
     * }
     * return value
     *      
     */
    public function pruneCache(): self
    {
        $cache_ttl_path = self::CACHE_PATH . 'cache.ttl';

        if (!is_file($cache_ttl_path)) {
            touch($cache_ttl_path);
        } else {
            if ((time() - $this->ttl) > filemtime($cache_ttl_path)) {
                // echo 'Pruning cache !';
                $cached_pages = glob(self::CACHE_PATH . '*.html');

                foreach ($cached_pages as $cached_page) {
                    if ((time() - $this->ttl) > filemtime($cached_page)) {
                        unlink($cached_page);
                    }
                }

                touch($cache_ttl_path);
            }
        }

        return $this;
    }
    /**
     * 
     */
    public function clearCache(): self
    {
        $cached_pages = glob(self::CACHE_PATH . '*.html');

        foreach ($cached_pages as $cached_page) {
            unlink($cached_page);
        }

        return $this;
    }
    
}
