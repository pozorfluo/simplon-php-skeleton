<?php

/**
 * 
 */

declare(strict_types=1);

namespace Helpers;

use PDO, PDOStatement, PDOException;

/**
 * 
 */
class DB
{
    public $pdo;

    /**
     * 
     */
    public function __construct(
        string $driver = 'mysql',
        string $host = '127.0.0.1',
        string $port = '3306',
        string $db = 'default',
        string $charset = 'utf8mb4',
        ?string $user = NULL,
        ?string $password = NULL,
        array $options = []
    ) {
        $default_options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $options = array_replace($default_options, $options);

        $dsn = $driver
            . ':host=' . $host
            . ';port=' . $port
            . ';dbname=' . $db
            . ';charset=' . $charset;

        try {
            $this->pdo = new PDO(
                $dsn,
                $user,
                $password,
                $options
            );
            // echo '<pre>'.var_export($this, true).'</pre><hr />';
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int) $e->getCode());
            // echo 'PDO Error : ' . $e->getMessage() . '<br/>';
            // die();
        }
    }

    /**
     * 
     */
    public function query(string $query, ?array $args = NULL): PDOStatement
    {
        if (is_null($args)) {
            return $this->pdo->query($query);
        }
        $statement = $this->pdo->prepare($query);
        $statement->execute($args);
        return $statement;
    }
}
