<?php

/**
 * 
 */

declare(strict_types=1);

namespace Templates;

use Interfaces\Templatable;
use Entities\Patient;

/**
 * 
 */
class MinichatForm implements Templatable
{
    protected $data;

    /**
     * 
     */
    public function __construct(
        // ChatUser $user,
        string $nickname = '',
        string $action = '',
        string $submit = 'Submit'
    ) {
        /**
         * todo
         *   - [ ] Retrieve id from a proper Validatable ChatUser or ...
         *   - [ ] Consider using CSRF guard token
         */
        $this->data = [
            'id' => '',
            'nickname' => $nickname,
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
    public function render(): string
    {
        if ($this->data['id'] !== '') {
            $input_id = '<input type="hidden" name="id" value="'
                . $this->data['id']
                . '" />';
        } else {
            $input_id = '';
        }

        return <<<TEMPLATE
<form class="minichat-form" action="{$this->data['action']}" method="POST">
    {$input_id}

    <input 
        type="text"
        name="nickname"
        value="{$this->data['nickname']}" 
        placeholder="YourName"
        required 
     />

    <input 
        type="text"
        name="msg-box"
        placeholder="Press ENTER to send !"
        required 
     />

    <input type="submit" value="{$this->data['submit']}" />
</form>    
TEMPLATE;
    }
}
