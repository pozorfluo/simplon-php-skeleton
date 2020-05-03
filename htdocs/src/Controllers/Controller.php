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

    protected $rendered_page = '';

    public function __construct(array $args = [])
    {
        $this->args = $args;

        /* get default associated view name */
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
     * note
     *   Output buffering is no longer required as everything is composed and
     *   rendered before emitting the page once
     */
    public function serve(): self
    {
        /* import collected 'variables' in current context */
        // extract($this->args);

        /* output buffering ON */
        // ob_start();
        $view_name = '\Views\\' . $this->view;
        $view = new $view_name($this->args);

        $computed_content = $view->compose()->render();

        $layout_name = '\Layouts\\' . $this->layout;

        $layout = new $layout_name($computed_content);
        // echo $layout->render();
        $rendered_page = $layout->render();
        echo $rendered_page;

        /* keep it around for optional caching */
        $this->rendered_page = $rendered_page;

        /* test and placeholder for deferred components */
        /* optional output buffering */
        // if (ob_get_level() == O) {ob_start()};
        for ($i = 0; $i < 3; $i++) {
            echo '<h2>DEFERRED COMPONENT PLACEHOLDER</h2>';
            /**
             * note
             *   Some padding may be necessary to force the webserver and
             *   client browser to push current output.
             * 
             *   Client browser have different schemes for output bufffering
             */
            echo str_pad('', 4096);
            // ob_flush();
            flush();
            sleep(1);
        }
        // ob_end_flush();

        /* output buffering OFF */
        // echo ob_get_clean();

        return $this;
    }

    /**
     * note
     *   May be called on a Controller who never (or not yet) received args,
     *   in which case it does nothing
     */
    public function cache(): self
    {

        if (isset($this->args['cached_file'])) {
            $cached_file = fopen($this->args['cached_file'], 'w');
            fwrite($cached_file, $this->rendered_page);
            fclose($cached_file);
            // file_put_contents($this->args['cached_file'], $this->rendered_page);
        }
        return $this;
    }
    /**
     * 
     */
    abstract public function run(array $args);
}
