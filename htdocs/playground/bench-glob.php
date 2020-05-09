<?php
$iterations = 10000;

                echo '//--------------------------------------------------------------<br />';
                $t = microtime(true);
                $i   = 0;
                while ($i < $iterations) {

                    $cached_pages = glob($this->cache_path . '*.html', GLOB_NOSORT);

                    foreach ($cached_pages as $cached_page) {
                        if ((time() - $this->cache_ttl) > filemtime($cached_page)) {
                            // unlink($cached_page);
                            $a = $cached_page;
                            // echo '<pre>' . var_export($cached_page, true) . '</pre>';
                        }
                    }

                    ++$i;
                }
                echo '<pre>' . var_export('GLOB_NOSORT :' . (microtime(true) - $t), true) . '</pre>';
                echo '//--------------------------------------------------------------<br />';
                $t = microtime(true);
                $i   = 0;
                while ($i < $iterations) {

                    $cached_pages = glob($this->cache_path . '*.html');

                    foreach ($cached_pages as $cached_page) {
                        if ((time() - $this->cache_ttl) > filemtime($cached_page)) {
                            // unlink($cached_page);
                            $a = $cached_page;
                            // echo '<pre>' . var_export($cached_page, true) . '</pre>';
                        }
                    }

                    ++$i;
                }
                echo '<pre>' . var_export('GLOB :' . (microtime(true) - $t), true) . '</pre>';
                echo '//--------------------------------------------------------------<br />';
                $t = microtime(true);
                $i   = 0;
                while ($i < $iterations) {

                    $cached_pages = glob($this->cache_path . '*.html', GLOB_NOSORT);

                    foreach ($cached_pages as $cached_page) {
                        if ((time() - $this->cache_ttl) > filemtime($cached_page)) {
                            // unlink($cached_page);
                            $a = $cached_page;
                            // echo '<pre>' . var_export($cached_page, true) . '</pre>';
                        }
                    }

                    ++$i;
                }
                echo '<pre>' . var_export('GLOB_NOSORT :' . (microtime(true) - $t), true) . '</pre>';
                echo '//--------------------------------------------------------------<br />';
                $t = microtime(true);
                $i   = 0;
                while ($i < $iterations) {
                    /* it does NOT matter if cache.ttl is tested, deleted */
                    if ($dir_handle = opendir($this->cache_path)) {
                        while (($cached_page = readdir($dir_handle)) !== false) {
                            if (is_file($cached_page)) {
                                $a = $cached_page;
                                // echo '<pre>' . var_export($cached_page, true) . '</pre>';
                            //     if ((time() - $this->cache_ttl) > filemtime($cached_page)) {
                            //         echo '<pre>' . var_export($cached_page, true) . '</pre>';
                            //         // unlink($cached_page);
                            //     }
                            }
                        }
                    }
                    ++$i;
                }
                echo '<pre>' . var_export('is_file :' . (microtime(true) - $t), true) . '</pre>';
                echo '//--------------------------------------------------------------<br />';
                $t = microtime(true);
                $i   = 0;
                while ($i < $iterations) {
                    if ($dir_handle = opendir($this->cache_path)) {
                        while (($cached_page = readdir($dir_handle)) !== false) {
                            if (preg_match('/.html/', $cached_page)) {
                                $a = $cached_page;
                                // echo '<pre>' . var_export($cached_page, true) . '</pre>';
                                // if ((time() - $this->cache_ttl) > filemtime($cached_page)) {
                                //     echo '<pre>' . var_export($cached_page, true) . '</pre>';
                                //     // unlink($cached_page);
                                // }
                            }
                        }
                    }
                    ++$i;
                }
                echo '<pre>' . var_export('preg_match :' . (microtime(true) - $t), true) . '</pre>';