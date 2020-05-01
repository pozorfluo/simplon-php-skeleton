<?php

/**
 * 
 */

declare(strict_types=1);

namespace Views;

use Templates\Nav;
use Templates\Footer;
use Templates\Checkerboard;
use Templates\InlinedCss;
use Templates\InlinedJs;

/**
 * 
 */
class Home extends View
{
    /**
     * todo
     *   - [ ] Build from data
     */
    public function compose(): self
    {

        $this->components['css'] = [
            new InlinedCss(['css/style.css'])
        ];

        $this->components['nav'] = [
            new Nav([
                'Home' => 'index.php?controller=Home',
                'Add Patient' => 'index.php?controller=Patient&action=Add',
                'List Patient' => 'index.php?controller=Patient&action=List',
                'Schedule' => 'index.php?controller=Patient&action=List',
            ])
        ];

        $this->components['content'] = [
            new InlinedCss(['css/Checkerboard.css']),
            new InlinedJs(['js/Checkerboard.js']),
            new Checkerboard($this->parameters['row'] ?? 6, $this->parameters['col'] ?? 6),
        ];


        $this->components['footer'] = [
            new Footer([
                '1x1' => 'index.php?controller=Home&action=value&row=1&col=1',
                '3x3' => 'index.php?controller=Home&action=value&row=3&col=3',
                '6x6' => 'index.php?controller=Home&action=value&row=6&col=6',
                '12x12' => 'index.php?controller=Home&action=value&row=12&col=12',
            ])
        ];
        return $this;
    }
}
