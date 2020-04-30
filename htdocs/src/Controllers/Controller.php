<?php

/**
 * 
 */

declare(strict_types=1);

namespace Controllers;

use Models\Model as Model;
use Views\View as View;

/**
 * 
 */
abstract class Controller
{
    protected $template_parameters = [];
    protected $model;
    protected $view;
    protected $layout = "Minimal";

    public function __construct()
    {
        $this->view = get_class($this);
        $namespace_end = strrpos($this->view, '\\');
        $this->view = substr($this->view, $namespace_end + 1);

        // echo "<pre>Controller()</pre>";
        // echo '<pre>' . var_export($this->view, true) . '</pre>';
    }

    /**
     * 
     */
    function set(array $parameters): self
    {
        $this->template_parameters = array_merge(
            $this->template_parameters,
            $parameters
        );
        return $this;
    }
    /**
     * 
     */
    public function serve(): void
    {
        /* imported collected 'variables' in current context */
        extract($this->template_parameters);

        /* output buffering ON */
        ob_start();
        require('src/Views/' . $this->view . '.php');
        $view_name = '\Views\\' . $this->view;
        $view = new $view_name();


        $computed_content = $view->compose()->render();
        // echo '<pre>'.var_export($computed_content, true).'</pre>';

        require('src/Layouts/' . $this->layout . '.php');
        $layout_name = '\Layouts\\' . $this->layout;

        $layout = new $layout_name($computed_content);
        echo $layout->render();

        /* output buffering OFF */
        echo ob_get_clean();
    }

    /**
     * 
     */
    abstract public function run(string $action = '', string $parameters = '');
}
