<?php

/**
 * 
 */

declare(strict_types=1);

namespace Views;

// use Interfaces\Templatable;
use Controllers\Controller;

/**
 * 
 */
abstract class View //implements Templatable
{
    public $data = [];
    public $components = [];
    // protected $controller;


    // public function __construct(Controller &$controller)
    // {
    //     $this->controller = &$controller;
    //     echo '<pre>' . var_export($controller, true) . '</pre>';
    //     echo '<pre>' . var_export($this->controller, true) . '</pre>';
    // }

    /**
     * Render components
     *   -> [string name => string rendered component]
     */
    abstract public function render(): array;

    /**
     * 
     */
    abstract public function compose();

    /**
     * 
     */
    // public function getRaw(): array
    // {
    //     return [
    //         'data' => $this->data,
    //         'components' => $this->components
    //     ];
    // }

    // /**
    //  * 
    //  */
    // public function inlineCss(string $path): self
    // {
    //     echo '<pre>' . var_export(getcwd(), true) . '</pre>';
    //     $this->components['css'] =
    //         '<style>' . (file_get_contents($path)) . '</style>';
    //     return $this;
    // }

    // /**
    //  * 
    //  */
    // public function inlineJs(string $path): self
    // {
    //     echo '<pre>' . var_export(getcwd(), true) . '</pre>';
    //     $this->components['js'] =
    //         '<script>' . require ($path) . '</script>';
    //     return $this;
    // }
}
