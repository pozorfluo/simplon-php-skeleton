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
    protected $parameters = [];
    protected $model;
    protected $view;
    protected $layout = "Minimal";

    public function __construct(array $parameters = [])
    {
        $this->parameters = $parameters;
        $this->view = get_class($this);
        $namespace_end = strrpos($this->view, '\\');
        $this->view = substr($this->view, $namespace_end + 1);
    }

    /**
     * 
     */
    public function set(array $parameters): self
    {
        $this->parameters = array_merge(
            $this->parameters,
            $parameters
        );
        return $this;
    }
    /**
     * 
     */
    public function serve(): void
    {
        /* import collected 'variables' in current context */
        // extract($this->parameters);

        /* output buffering ON */
        ob_start();
        require('src/Views/' . $this->view . '.php');
        $view_name = '\Views\\' . $this->view;
        $view = new $view_name($this->parameters);

        prettyDump([$this]);
        echo '<pre>' . var_export($this, true) . '</pre>';
        prettyDump([$view]);
        echo '<pre>' . var_export($view, true) . '</pre>';

        $computed_content = $view->compose()->render();

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
    abstract public function run(array $parameters);
}
