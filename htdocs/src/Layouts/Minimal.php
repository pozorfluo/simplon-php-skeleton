<?php

/**
 * 
 */

declare(strict_types=1);



namespace Layouts;

use Interfaces\Templatable as Templatable;

/**
 * 
 */
class Minimal implements Templatable
{
    public $data = [];

    /**
     * note
     *   Provide innocuous default value to make the template displayable
     */
    public function __construct(
        array $rendered_components = []
    ) {
        $this->data = array_merge(
            [
                'page_title' => 'hello-php',
                'css' => '',
                'nav' => '',
                'content' => '',
                'footer' => '',
                'js' => ''
            ],
            $rendered_components
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
        $page_title = $this->data['page_title'] ?? 'hello-php';

        return <<<TEMPLATE
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{$this->data['page_title']}></title>
    {$this->data['css']}
</head>

<body>
    {$this->data['nav']}

    {$this->data['content']}
    
    {$this->data['footer']}

    {$this->data['js']}
</body>
</html>
TEMPLATE;
    }
}

