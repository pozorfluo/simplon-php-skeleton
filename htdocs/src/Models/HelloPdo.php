<?php

/**
 * 
 */

declare(strict_types=1);

namespace Models;

use Exception;
use Helpers\DBConfig;

/**
 * 
 */
class HelloPdo extends Model
{
    protected $db_configs;
    protected $db;

    public $exercises = [
        'demo' => [
            'config' => 'colyseum',
            'query' => "SELECT
                            COUNT(*)
                        FROM 
                            `clients`;"
        ],
    ];
    
    /**
     * 
     */
    public function __construct(
        DBConfig $db_configs,
        array $exercises = []
    ) {
        // echo '<pre>HelloPdo->__construct()</pre>';
        $this->db_configs = $db_configs;
        $this->exercises = array_replace($this->exercises, $exercises);
    }

    /**
     * 
     */
    private function useConfig(string $config_name): bool
    {
        // echo '<pre>HelloPdo->useConfig() ' . $config_name . '</pre>';

        $this->db = $this->db_configs->get($config_name);
        return !is_null($this->db);
    }

    /**
     * 
     */
    public function runExercise(string $name): ?array
    {
        // echo '<pre>HelloPdo->runExercise()</pre>';
        if (isset($this->exercises[$name])) {
            if ($this->useConfig($this->exercises[$name]['config'])) {

                $statement = $this->db->query($this->exercises[$name]['query']);
                return $statement->fetchAll();
            }
            echo '<pre>HelloPdo->runExercise() error : Could not select db.</pre>';
            return null;
        };
        echo '<pre>HelloPdo->runExercise() error : Exercise name not found.</pre>';

        return null;
    }

    /**
     * 
     */
    public function getExercise(string $name): string
    {
        // echo '<pre>HelloPdo->getExercise()</pre>';
        if (isset($this->exercises[$name])) {
            return $this->exercises[$name]['query'];
        };
        return 'Exercise query not found.';
    }

    /**
     * 
     */
    public function execute(
        string $config_name,
        string $query,
        ?array $args = NULL,
        bool $transaction = false
    ): ?array {
        // echo '<pre>HelloPdo->execute()</pre>';
        if ($this->useConfig($config_name)) {
            /* todo - [ ]sanitize here ! */

            if ($transaction) {
                return $this->transaction($query, $args);
            } else {
                $statement = $this->db->query($query, $args);
                return $statement->fetchAll();
            }
        }
        echo '<pre>HelloPdo->execute() error : Could not select db.</pre>';
        return null;
    }

    /**
     * Wrap a single :sadface: query in a pdo transaction
     */
    protected function transaction(
        string $query,
        ?array $args = NULL
    ): ?array {
        // echo '<pre>HelloPdo->transaction()</pre>';
        try {
            $this->db->pdo->beginTransaction();
            $statement = $this->db->query($query, $args);
            $this->db->pdo->commit();
            // echo '<pre>HelloPdo->transaction() commit : ok.</pre>';
            return $statement->fetchAll();
        } catch (Exception $e) {
            $this->db->pdo->rollback();
            // throw $e;
            echo '<pre>HelloPdo->transaction() error : failed :/ .</pre>';
            return null;
        }
    }
}
