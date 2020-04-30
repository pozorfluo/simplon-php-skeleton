<?php

/**
 * 
 */

declare(strict_types=1);

namespace Templates;

use Interfaces\Templatable as Templatable;

/**
 * 
 */
class PatientForm implements Templatable
{
    public $data;

    /**
     * 
     */
    public function __construct(
        // string $id =  '',
        string $lastname =  '',
        string $firstname =  '',
        string $birthdate =  '',
        string $phone =  '',
        string $mail =  '',
        string $action = '',
        string $submit =  'Submit'
    ) {
        $this->data = [
            // 'id' => $id,
            'lastname' => $lastname,
            'firstname' => $firstname,
            'birthdate' => $birthdate,
            'phone' => $phone,
            'mail' => $mail,
            'action' => $action,
            'submit' => $submit
        ];
    }

    /**
     * 
     */
    public function getRaw(): array
    {
        return $this->data;
    }
    
    /**
     * 
     */
    public function render(): void
    {
        echo <<<VIEW
<form action="{$this->data['action']}" method="POST">

    <label for="lastname">Last Name</label>
    <input type="text"
     name="lastname"
     value="{$this->data['lastname']}" 
     required />

    <label for="firstname">First Name</label>
    <input 
        type="text"
        name="firstname"
        value="{$this->data['firstname']}" 
        required 
     />

    <label for="birthdate">Birth Date</label>
    <input 
        type="date"
        name="birthdate"
        value="{$this->data['birthdate']}"
        required
    />

    <label for="phone">Phone (10 digits)</label>
    <input
        type="tel"
        name="phone"
        pattern="[0-9]{10}"
        value="{$this->data['phone']}"
        required
    />

    <label for="mail">E-mail</label>
    <input 
        type="email" 
        name="mail" 
        value="{$this->data['mail']}" 
        required 
    />

    <input type="submit" value="{$this->data['submit']}" />
</form>    
VIEW;
    }
}


// public function __construct(
//     ?int $id = NULL,
//     ?string $lastname = NULL,
//     ?string $firstname = NULL,
//     ?string $birthdate = NULL,
//     ?string $phone = NULL,
//     ?string $mail = NULL,
//     ?string $action = NULL
// ) {
//     $this->data = [
//         'lastname' => $lastname ?? '',
//         'firstname' => $firstname ?? '',
//         'birthdate' => $birthdate ?? '',
//         'phone' => $phone ?? '',
//         'mail' => $mail ?? '',
//         'action' => $action ?? htmlspecialchars($_SERVER['PHP_SELF'])
//     ];
// }
