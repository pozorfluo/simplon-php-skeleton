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
class InlinedCss implements Templatable
{
    public $data;

    /**
     * 
     */
    public function __construct(
        array $paths = ['css/style.css']
    ) {
        $this->data = $paths;
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
        $rendered_template = '<style>';
        foreach ($this->data as $path) {

            $rendered_template .= file_get_contents($path);

        }

        $rendered_template .= '</style>';
        return $rendered_template;
    }
}
