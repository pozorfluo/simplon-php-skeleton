<?php

/**
 * 
 */

declare(strict_types=1);

namespace Helpers;

use Controllers\Controller as Controller;

/**
 * index.php?controller=Home&action=value&p1=v1&p2=v2&pn=vn"
 *   or ?
 * /Controller/Action/p1=v1&p2=v2&pn=vn
 */
class Dispatcher
{
    protected $request;
    protected $controller;

    protected $cache_ttl = 600; /* seconds */
    protected $cache_path = ROOT . 'cache/';

    public function __construct()
    {
        parse_str($_SERVER['QUERY_STRING'], $this->request);

        $base_name = $_SERVER['QUERY_STRING'];
        if ($base_name === '') {
            $base_name = 'index';
        }

        $this->request['cached_file'] =
            $this->cache_path . $base_name . '.html';

        if (!isset($this->request['controller'])) {
            $this->request['controller'] = 'Home';
        }
    }

    /**
     * 
     */
    public function call(): self
    {
        if ($this->isCached()) {
            // echo 'Serving Cached !';
            readfile($this->request['cached_file']);
        } else {
            // echo 'Serving Fresh !';
            ($this->controller ?? $this->load())->run($this->request);
        }

        return $this;
    }
    /**
     * 
     */
    public function load(): Controller
    {
        $controller_name = '\Controllers\\' . $this->request['controller'];
        unset($this->request['controller']);
        $this->controller = new $controller_name();

        return $this->controller;
    }

    /**
     *
     */
    public function isCached(): bool
    {
        $file_path = $this->request['cached_file'];
        return file_exists($file_path)
            && (time() - $this->cache_ttl) < filemtime($file_path);
    }

    /**
     *  note
     *    Will erase content of cached file if used before call()
     *    Subsequent call() may serve that cached empty files
     */
    public function cache(): self
    {
        ($this->controller ?? $this->load())->cache();

        $cache_ttl_path = $this->cache_path . 'cache.ttl';
        if (!file_exists($cache_ttl_path)) {
            touch($cache_ttl_path);
        }
        $this->pruneCache();

        return $this;
    }

    /**
     * Create cache.ttl ticker if it does NOT exist
     * If at least a ttl period has elapsed since last pruning
     *   Delete each cached files past ttl
     *   Reset ticker
     */
    public function pruneCache(): self
    {
        $cache_ttl_path = $this->cache_path . 'cache.ttl';

        if (!file_exists($cache_ttl_path)) {
            touch($cache_ttl_path);
        } else {
            if ((time() - $this->cache_ttl) > filemtime($cache_ttl_path)) {
                // echo 'Pruning cache !';
                $cached_pages = glob($this->cache_path . '*.html');

                foreach ($cached_pages as $cached_page) {
                    if ((time() - $this->cache_ttl) > filemtime($cached_page)) {
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
        $cached_pages = glob($this->cache_path . '*.html');
        // echo '<pre>' . var_export($cached_pages, true) . '</pre>';

        foreach ($cached_pages as $cached_page) {
            unlink($cached_page);
        }

        return $this;
    }
}
