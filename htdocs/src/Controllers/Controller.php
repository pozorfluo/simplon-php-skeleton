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
    protected $model;
    protected $view;

    /**
     * 
     */
    abstract public function run(string $action, string $parameters): void;


}
