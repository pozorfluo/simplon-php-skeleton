<?php

/**
 * 
 */

declare(strict_types=1);

namespace Entities;

/**
 * 
 */
class Patient extends Entity
{
    function __construct(
        string $id =  '',
        string $lastname =  '',
        string $firstname =  '',
        string $birthdate =  '',
        string $phone =  '',
        string $mail =  ''
    ) {
        parent::__construct(
            [
                'id' => $id,
                'lastname' => $lastname,
                'firstname' => $firstname,
                'birthdate' => $birthdate,
                'phone' => $phone,
                'mail' => $mail
            ],
            [
                $id => FILTER_VALIDATE_INT,
                $phone => [
                    'filter' => FILTER_VALIDATE_REGEXP,
                    'options' => ['regexp' => '([0-9]{10})']
                ],
                $mail => FILTER_VALIDATE_EMAIL,
            ]
        );
    }
}
