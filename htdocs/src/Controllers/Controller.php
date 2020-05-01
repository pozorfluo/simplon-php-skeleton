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
    protected $args = [];
    protected $model;
    protected $view;
    protected $layout = "Minimal";

    public function __construct(array $args = [])
    {
        $this->args = $args;
        $this->view = get_class($this);
        $namespace_end = strrpos($this->view, '\\');
        $this->view = substr($this->view, $namespace_end + 1);
    }

    /**
     * 
     */
    public function set(array $args): self
    {
        $this->args = array_merge(
            $this->args,
            $args
        );
        return $this;
    }
    /**
     * 
     */
    public function serve(): void
    {
        /* import collected 'variables' in current context */
        // extract($this->args);

        /* output buffering ON */
        // ob_start();
        $view_name = '\Views\\' . $this->view;
        $view = new $view_name($this->args);

        // prettyDump([$this]);
        // echo '<pre>' . var_export($this, true) . '</pre>';
        // prettyDump([$view]);
        // echo '<pre>' . var_export($view, true) . '</pre>';

        $computed_content = $view->compose()->render();

        $layout_name = '\Layouts\\' . $this->layout;

        $layout = new $layout_name($computed_content);
        echo $layout->render();

        /* output buffering OFF */
        // echo ob_get_clean();
    }

    /**
     * 
     */
    abstract public function run(array $args);
}
