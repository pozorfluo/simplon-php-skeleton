<?php

declare(strict_types=1);

/**
 * 
 */
class HelloPdoModel
{
    protected $db;

    public function __construct(DB $db)
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
}
