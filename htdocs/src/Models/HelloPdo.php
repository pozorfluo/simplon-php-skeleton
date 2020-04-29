<?php

declare(strict_types=1);

namespace Models;

/**
 * 
 */
class HelloPdo
{
    protected $db_configs;
    protected $db;

    public $exercises = [
        'demo' => [
            'config' => 'colyseum',
            'query' => "SELECT
                            *
                        FROM 
                            `clients`;"
        ],
    ];

    public function __construct(\Helpers\DBConfig $db_configs, array $exercises = [])
    {
        // echo '<pre>HelloPdo->__construct()</pre>';
        $this->db_configs = $db_configs;
        $this->exercises = array_replace($this->exercises, $exercises);
    }

    private function useConfig(string $config_name): bool
    {
        // echo '<pre>HelloPdo->useConfig() ' . $config_name . '</pre>';

        $this->db = $this->db_configs->get($config_name);
        return !is_null($this->db);
    }

    public function runExercise(string $name): ?array
    {
        // echo '<pre>HelloPdo->runExercise()</pre>';
        if (isset($this->exercises[$name])) {
            if ($this->useConfig($this->exercises[$name]['config'])) {

                $statement = $this->db->query($this->exercises[$name]['query']);
                return $statement->fetchAll();
            }
            echo '<pre>HelloPdo-> error : Could not select db.</pre>';
            return null;
        };
        echo '<pre>HelloPdo-> error : Exercise name not found.</pre>';

        return null;
    }

    public function getExercise(string $name): string
    {
        // echo '<pre>HelloPdo->getExercise()</pre>';
        if (isset($this->exercises[$name])) {
            return $this->exercises[$name]['query'];
        };
        return 'Exercise query not found.';
    }
}
