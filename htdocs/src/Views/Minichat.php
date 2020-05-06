<?php

/**
 * 
 */

declare(strict_types=1);

namespace Views;

use Controllers\Controller;
use Templates\Fonts;
use Templates\Nav;
use Templates\Footer;
use Templates\InlinedCss;
use Templates\InlinedJs;
use Templates\Console;

/**
 *
 */
class Minichat extends View
{
    /**
     * Define defaults, take arguments
     */
    public function __construct(Controller $controller)
    {
        parent::__construct($controller);
        $defaults = [];
        $this->args = array_replace($defaults, $this->args);
    }
    /**
     * todo
     *   - [ ] Build from data
     */
    public function compose(): self
    {

        $this->components['fonts'] = [
            new Fonts(['resources/fonts/font-ibmplexsans-min.html'])
        ];
        $this->components['css'] = [
            new InlinedCss(['css/style.min.css'])
        ];

        $this->components['nav'] = [
            new Nav([
                'Home' => 'index.php?controller=Home',
                'List Patient' => '?controller=Patient&action=List',
                'Add Patient' => '?controller=Patient&action=Add',
                'Minichat' => '?controller=Minichat',
            ])
        ];

        /* mock massaged data */
        $this->args['minichat_msg'] = [
            '[Rupaul] Hello, hello, hello !',
            '[Rupaul] Sissy that walk !'
        ];

        $this->components['content'] = [
            new Console($this->args['minichat_msg']),
        ];


        $this->components['footer'] = [
            new Footer([
                'Minichat' => '?controller=MinichatAPI',
            ]),
        ];

        $this->components['js'] = [
            new InlinedJs(['js/Minichat.min.js'])
        ];

        return $this;
    }
}
