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

    public $exercises;

    public function __construct(\Helpers\DBConfig $db_configs, array $exercises = [])
    {
        // echo 'todo - [ ] Make getEx? take a query and a config';
        echo '<pre>HelloPdo->__construct()</pre>';
        $this->db_configs = $db_configs;
        $this->exercises = $exercises;
        // $this->db = $this->db_configs->get();
    }

    private function useConfig(string $config_name): bool
    {
        echo '<pre>HelloPdo->useConfig() ' . $config_name . '</pre>';

        $this->db = $this->db_configs->get($config_name);
        return !is_null($this->db);

    }
    public function runExercise(string $name): array
    {
        echo '<pre>HelloPdo->runExercise()</pre>';
        if ($this->useConfig('colyseum')) {
            $query =
                "SELECT
                    `id`,
                    `lastName` AS `last name`,
                    `firstName` AS `first name`,
                    `birthDate` AS `date of birth`,
                    `card` AS `has a card ?`,
                    `cardNumber` AS `card number`
                FROM 
                    `clients` 
                ORDER BY 
                    `lastName` ASC;";

            $statement = $this->db->query($query);
            return $statement->fetchAll();
        }
        //todo : - [ ] should throw
        return ['error : Could not select db'];
    }

    public function getEx1(): array
    {
        echo '<pre>HelloPdo->getEx1()</pre>';
        if ($this->useConfig('colyseum')) {
            $query =
                "SELECT
                    `id`,
                    `lastName` AS `last name`,
                    `firstName` AS `first name`,
                    `birthDate` AS `date of birth`,
                    `card` AS `has a card ?`,
                    `cardNumber` AS `card number`
                FROM 
                    `clients` 
                ORDER BY 
                    `lastName` ASC;";

            $statement = $this->db->query($query);
            return $statement->fetchAll();
        }
        //todo : - [ ] should throw
        return ['error : Could not select db'];
    }

    public function getEx2(): array
    {
        if ($this->useConfig('colyseum')) {
            $query =
                "SELECT
                    `id`,
                    `type` AS `show type`
                FROM 
                    `showTypes` 
                ORDER BY 
                    `id` ASC;";

            $statement = $this->db->query($query);

            return $statement->fetchAll();
        }
        //todo : - [ ] should throw
        return ['error : Could not select db'];
    }

    public function getEx3(): array
    {
        if ($this->useConfig('colyseum')) {
            $query =
                "SELECT
                    `id`,
                    `lastName` AS `last name`,
                    `firstName` AS `first name`,
                    `birthDate` AS `date of birth`,
                    `card` AS `has a card ?`,
                    `cardNumber` AS `card number`
                FROM 
                    `clients` 
                ORDER BY 
                    `id` ASC
                LIMIT 
                    20;";

            $statement = $this->db->query($query);

            return $statement->fetchAll();
        }
        //todo : - [ ] should throw
        return ['error : Could not select db'];
    }

    public function getEx4(): array
    {
        if ($this->useConfig('colyseum')) {
            $query =
                "SELECT
                    `clients`.`id`,
                    `lastName` AS `last name`,
                    `firstName` AS `first name`,
                    `birthDate` AS `date of birth`,
                    `clients`.`cardNumber` AS `card number`
                FROM 
                    `clients` 
                INNER JOIN
                    `cards` ON `clients`.`cardNumber` = `cards`.`cardNumber`
                WHERE
                    `cards`.`cardTypesId` = 1
                ORDER BY 
                    `clients`.`id` ASC;";

            $statement = $this->db->query($query);

            return $statement->fetchAll();
        }
        //todo : - [ ] should throw
        return ['error : Could not select db'];
    }

    public function getEx5(): array
    {
        if ($this->useConfig('colyseum')) {
            $query =
                "SELECT
                    `lastName` AS `client last name`,
                    `firstName` AS `client first name`
                FROM 
                    `clients` 
                WHERE
                    `lastName` LIKE 'M%'
                ORDER BY 
                    `firstName` ASC;";

            $statement = $this->db->query($query);

            return $statement->fetchAll();
        }
        //todo : - [ ] should throw
        return ['error : Could not select db'];
    }

    public function getEx6(): array
    {
        if ($this->useConfig('colyseum')) {
            $query =
                "SELECT
                    `title` AS `show`,
                    `performer` AS `by`,
                    `date` AS `on`,
                    `startTime` AS `at`
                FROM 
                    `shows`
                ORDER BY 
                    `title` ASC;";

            $statement = $this->db->query($query);

            return $statement->fetchAll();
        }
        //todo : - [ ] should throw
        return ['error : Could not select db'];
    }

    public function getEx7(): array
    {
        echo '<pre>HelloPdo->getEx7()</pre>';
        if ($this->useConfig('colyseum')) {
            $query =
                "SELECT
                    `id`,
                    `lastName` AS `last name`,
                    `firstName` AS `first name`,
                    `birthDate` AS `date of birth`,
                IF(`card`=1, 'YES', 'NO') AS `has a card ?`,
                     `cardNumber` AS `card number`
                FROM 
                    `clients` 
                ORDER BY 
                    `id` ASC;";

            $statement = $this->db->query($query);

            return $statement->fetchAll();
        }
        //todo : - [ ] should throw
        return ['error : Could not select db'];
    }

    public function getEx2_1(): array
    {
        echo '<pre>HelloPdo->getEx2_1()</pre>';
        if ($this->useConfig('patients')) {
            $query =
                "SELECT
                 *
                FROM 
                    `patients` 
                ORDER BY 
                    `id` ASC;";

            $statement = $this->db->query($query);

            return $statement->fetchAll();
        }
        //todo : - [ ] should throw
        return ['error : Could not select db'];
    }
}
