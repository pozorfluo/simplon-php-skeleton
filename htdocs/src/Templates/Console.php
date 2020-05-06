<?php

/**
 * 
 */

declare(strict_types=1);

namespace Templates;

use Interfaces\Templatable;

/**
 * 
 */
class Console implements Templatable
{
    protected $data;

    /**
     * 
     */
    public function __construct(
        array $content,
        string $class = 'console',
        int $row_count = 10,
        int $col_count = 90,
        int $max_length = 2000,
        string $id = 'hook-console',
        bool $deferred = false
    ) {
        /**
         * todo
         *   - [ ] Expand the content from mixed array to string properly
         */
        $this->data['content'] = implode('&#13;&#10;', $content);
        $this->data['class'] = $class;
        $this->data['row_count'] = $row_count;
        $this->data['col_count'] = $col_count;
        $this->data['max_length'] = $max_length;
        $this->data['id'] = $id;
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

        $rendered_template = 
<<<TEMPLATE
<textarea id="{$this->data['id']}"  
          class="{$this->data['class']}"  
          cols="{$this->data['col_count']}"
          rows="{$this->data['row_count']}" 
          maxlength="{$this->data['max_length']}"
          style="white-space: pre-line;"
          readonly>
          {$this->data['content']}
    </textarea> 
TEMPLATE;

        return $rendered_template;
    }
}
