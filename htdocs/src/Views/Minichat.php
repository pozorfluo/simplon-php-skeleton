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
use Templates\MinichatForm;

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
            new Fonts(['resources/fonts/font-ibmplexsans.min.html'])
        ];
        $this->components['css'] = [
            new InlinedCss([
                'css/style.min.css',
                'css/Minichat.min.css'
            ])
        ];

        $this->components['nav'] = [
            new Nav([
                'Home' => 'index.php?controller=Home',
                'List Patient' => '?controller=Patient&action=List',
                'Add Patient' => '?controller=Patient&action=Add',
                'Minichat' => '?controller=Minichat',
            ])
        ];

        $this->args['minichat_msg'] = [
            '[Minichat] Hello, hello, hello !',
        ];

        $this->components['content'] = [
            new Console(['[Minichat] Connecting ...']),
            // new Console(["Press enter to send !"], 'msg-box', 1, 90, 280, 'hook-msg-box', false),
            new MinichatForm(),
        ];


        $this->components['footer'] = [
            new Footer([
                'Minichat' => '?controller=MinichatAPI',
            ]),
        ];

        $this->components['js'] = [
            // new InlinedJs(['js/Minichat.min.js']),
            new InlinedJs(['js/Minichat.js']),
        ];

        return $this;
    }
}
