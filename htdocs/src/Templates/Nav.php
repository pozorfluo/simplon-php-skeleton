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

use Interfaces\ITemplate as ITemplate;

/**
 * 
 */
class Nav implements ITemplate
{
    public $data;

    /**
     * 
     */
    public function __construct(
        array $links = ['Project Name' => 'Home/Welcome/id'])
    {
        $this->data = $links;
    }

    /**
     * 
     */
    public function get(): array
    {
        return $this->data;
    }

    /**
     * 
     */
    public function render(): void
    {
        $rendered_template = '<nav>';
        foreach ($this->data as $link => $href) {

            $rendered_template .= <<<TEMPLATE
<a href="{$href}">
    <div class="nav-button">
        {$link}
    </div>
</a>
TEMPLATE;
        }

        $rendered_template .= '</nav><hr />';
        echo $rendered_template;
    }
}
