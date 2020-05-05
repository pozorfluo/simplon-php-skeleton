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
class Checkerboard implements Templatable
{
    protected $data;

    /**
     * 
     */
    public function __construct(int $row_count = 3, int $col_count = 3)
    {
        $this->data['row_count'] = min(12, max(1, $row_count));
        $this->data['col_count'] = min(12, max(1, $col_count));
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
        $css_col_width = 'col-' . intdiv(12, $this->data['col_count']);

        $rendered_template = 
<<<TEMPLATE
<style>:root {
    --row-count: {$this->data['row_count']};
    --col-count: {$this->data['col_count']};
}</style>
<div class="square-container"><div class="row">
TEMPLATE;


        for ($col = $this->data['col_count']; $col >= 1; $col--) {
            $rendered_template .=
<<<TEMPLATE
<div class="{$css_col_width}"><div>
TEMPLATE;

            for ($row = $this->data['row_count']; $row >= 1; $row--) {
                $rendered_template .=
<<<TEMPLATE
<div class="tran-bouncyOS">
    <div class="button square">
    </div>
</div>
TEMPLATE;
            }

            $rendered_template .= 
<<<TEMPLATE
</div></div>
TEMPLATE;
        }

        $rendered_template .= 
<<<TEMPLATE
</div></div>
TEMPLATE;
        return $rendered_template;
    }
}
