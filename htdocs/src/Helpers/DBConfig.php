<?php

/**
 * 
 */

declare(strict_types=1);

namespace Helpers;

/**
 * 
 */
class DBConfig
{
    protected $configs;

    public function __construct(string $file)
    {
        // echo '<pre>DBConfig->__construct()</pre>';
        if (file_exists($file)) {
            $json_configs = file_get_contents($file);
            $this->configs = json_decode($json_configs, true);
        } else {
            $this->configs = [
                'default' => [
                    'DB_DRIVER' => 'mysql',
                    'DB_HOST' => '127.0.0.1',
                    'DB_PORT' => '3306',
                    'DB_NAME' => 'default',
                    'DB_CHARSET' => 'utf8mb4',
                    'DB_USER' => null,
                    'DB_PASSWORD' => null,
                ]
            ];
        }
    }

    public function get(?string $config_name = null): ?DB
    {
        $config_name = $config_name ?? array_key_first($this->configs);
        // echo '<pre>DBConfig->get() ' . $config_name . '</pre>';

        if (isset($this->configs[$config_name])) {
            return new DB(
                $this->configs[$config_name]['DB_DRIVER'],
                $this->configs[$config_name]['DB_HOST'],
                $this->configs[$config_name]['DB_PORT'],
                $this->configs[$config_name]['DB_NAME'],
                $this->configs[$config_name]['DB_CHARSET'],
                $this->configs[$config_name]['DB_USER'],
                $this->configs[$config_name]['DB_PASSWORD']
            );
        }
        return null;
    }
}
