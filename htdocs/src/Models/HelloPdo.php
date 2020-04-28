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

    public function __construct(\Helpers\DBConfig $db_configs)
    {
        echo 'todo - [ ] Make getEx? take a query and a config';
        $this->db_configs = $db_configs;
        $this->db = $this->db_configs->get();
    }

    private function useConfig(string $config_name): bool
    {
        if (!$this->db_configs->isSelected($config_name)) {
            if ($this->db_configs->select($config_name)) {
                $this->db = $this->db_configs->get();
                return true;
            } else {
                return false;
            }
        }
        return true;
    }

    public function getEx1(): array
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
}
