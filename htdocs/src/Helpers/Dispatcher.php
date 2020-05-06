<?php

/**
 * 
 */

declare(strict_types=1);

namespace Helpers;

use Controllers\Controller;
use Exception;

/**
 * index.php?controller=Home&action=value&p1=v1&p2=v2&pn=vn"
 *   or ?
 * /Controller/Action/p1=v1&p2=v2&pn=vn
 * 
 * see https://www.php.net/manual/en/function.filter-has-var.php
 */
class Dispatcher
{
    protected $request;
    protected $controller;

    protected $cache_ttl = 6; /* seconds */
    protected $cache_path = ROOT . 'cache/';

    public function __construct(array $config)
    {
        parse_str($_SERVER['QUERY_STRING'], $this->request);

        /**
         * Validate query against whitelist of registered components
         * Redirect to Home if query string specifies junk controller
         */
        if ((!isset($this->request['controller'])
            || (!in_array($this->request['controller'], $config['components']['Controllers'], true)))) {
            // header("Location: /?controller=Home");
            // exit;

            /**
             * note
             *   Can we avoid a redirection and pretend it is ok ? 
             *   If you need to remember this happened :
             *     Compare QUERY_STRING and REQUEST_URI :wink:
             **/
            $this->request['controller'] = 'Home';
            $_SERVER['QUERY_STRING'] = 'controller=Home';
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SERVER['HTTP_X_HTTP_METHOD'])) {
            $this->request['method'] = $_SERVER['HTTP_X_HTTP_METHOD'];
        } else {
            $this->request['method'] = $_SERVER['REQUEST_METHOD'];
        }

        /* sanitize */
        $base_name = rawurlencode($_SERVER['QUERY_STRING']);

        /* no need to default to index anymore */
        // if ($base_name === '') {
        //     $base_name = 'index';
        // }

        $this->request['db_configs'] = $config['db_configs'];
        $this->request['cached_file'] =
            substr($this->cache_path . $base_name, 0, 250) . '.html';
    }

    /**
     * todo
     *   - [x] Figure out how to prevent a call to a method that does
     *         NOT represent an action ?!
     *     + [x] Consider prepending / appending with 'run' or Action' 
     *           both to make it clear what is meant to be a callable 
     *           action and thwart malicious requests
     */
    public function call(): self
    {
        if ($this->isCached()) {
            // echo 'Serving Cached !';
            readfile($this->request['cached_file']);
        } else {
            // echo 'Serving Fresh !';
            /* 'escaping' and providing default action */
            $this->request['action'] =
                'run' . ($this->request['action'] ?? 'Default');

            /* use existing controller or load one */
            if (method_exists(
                $this->controller ?? $this->load(),
                $this->request['action']
            )) {
                /* requested action exists, run it */
                $this->controller->{$this->request['action']}($this->request);
            } else {
                /* run default action */
                $this->request['action'] = 'runDefault';
                $this->controller->runDefault($this->request);
            }
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
        return is_file($file_path)
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
        if (!is_file($cache_ttl_path)) {
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

        if (!is_file($cache_ttl_path)) {
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

        foreach ($cached_pages as $cached_page) {
            unlink($cached_page);
        }

        return $this;
    }
}
