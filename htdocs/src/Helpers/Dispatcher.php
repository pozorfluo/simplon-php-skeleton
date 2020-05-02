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

        $this->request['cached_file'] =
            $this->cache_path . $_SERVER['QUERY_STRING'] . '.html';

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
            readfile($this->request['cached_file']);
        } else {
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
        echo '<pre>' . var_export($this->controller, true) . '</pre>';

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
        // $this->controller->cache();
        // echo '<pre>'.var_export($this->controller, true).'</pre>';

        $cache_ttl_path = $this->cache_path . 'cache.ttl';
        if (!file_exists($cache_ttl_path)) {
            touch($cache_ttl_path);
        }
        $this->invalidateCache();

        return $this;
    }

    /**
     * 
     */
    public function invalidateCache(): self
    {
        $cache_ttl_path = ROOT . 'cache.ttl';
        if (file_exists($cache_ttl_path)) {
            echo 'cache_ttl exists';
        } else {
            touch($cache_ttl_path);
        }
        return $this;
    }
    /**
     * 
     */
    public function clearCache(): self
    {
        $glob = glob($this->cache_path . '*.html');
        echo '<pre>' . var_export($glob, true) . '</pre>';

        foreach ($glob as $file_path) {
            unlink($file_path);
        }
        return $this;
    }
}
