<?php

/**
 * 
 */

declare(strict_types=1);

namespace Templates;

use Interfaces\Templatable as Templatable;
use Entities\Patient as Patient;

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
        Patient $patient,
        string $action = '',
        string $submit =  'Submit'
    ) {
        $this->data = array_merge(
            $patient->getData(),
            [
                'action' => $action,
                'submit' => $submit
            ]
        );
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
    public function render(): string
    {
        if ($this->data['id'] !== '') {
            $input_id = '<input type="hidden" name="id" value="'
                . $this->data['id']
                . '" />';
        } else {
            $input_id = '';
        }
        return <<<VIEW
<form action="{$this->data['action']}" method="POST">
    {$input_id}
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
