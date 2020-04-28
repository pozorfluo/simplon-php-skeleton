<?php

declare(strict_types=1);

namespace Models;

/**
 * 
 */
class HelloPdo
{
    protected $db;

    public function __construct(\DB $db)
    {
        $this->db = $db;
    }

    public function getEx1(): array
    {
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

    public function getEx2(): array
    {
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

    public function getEx3(): array
    {
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

    public function getEx4(): array
    {
        $query =
            "SELECT
                 `id`,
                 `lastName` AS `last name`,
                 `firstName` AS `first name`,
                 `birthDate` AS `date of birth`,
                 `cardNumber` AS `card number`
             FROM 
                 `clients` 
             WHERE
                 `card` = 1
             ORDER BY 
                 `id` ASC;";

        $statement = $this->db->query($query);

        return $statement->fetchAll();
    }

    public function getEx5(): array
    {
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

    public function getEx6(): array
    {
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

    public function getEx7(): array
    {
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
}
