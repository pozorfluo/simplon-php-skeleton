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
class PDOModel extends Model
{
    protected $db_configs;
    protected $db;
    
    /**
     * 
     */
    public function __construct(
        DBConfig $db_configs
    ) {
        $this->db_configs = $db_configs;
    }

    /**
     * todo
     *   - [ ] Avoid instancing a DB everytime if config is up and adequate
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
        // echo '<pre>HelloPdo->execute() error : Could not select db.</pre>';
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
            // echo '<pre>HelloPdo->transaction() error : failed :/ .</pre>';
            return null;
        }
    }
}
