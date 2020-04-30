<?php

/**
 * 
 */

declare(strict_types=1);

?>
<?php

/**
 * 
 */


namespace Templates;

use Interfaces\Templatable as Templatable;

/**
 * 
 */
class Nav implements Templatable
{
    public $data;

    /**
     * 
     */
    public function __construct(
        array $links = ['Project Name' => 'index.php?controller=Home']
    ) {
        $this->data = $links;
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
        $rendered_template = '<nav>';
        foreach ($this->data as $link => $href) {

            $rendered_template .=
                <<<TEMPLATE
<a href="{$href}">
    <div class="nav-button">
        {$link}
    </div>
</a>
TEMPLATE;


        }

        $rendered_template .= '</nav><hr />';
        return $rendered_template;
    }
}
