<?php

/**
 * 
 */

declare(strict_types=1);

namespace Views;

use Templates\Nav;
use Templates\Footer;
use Templates\Checkerboard;
use Templates\Image;
use Templates\InlinedCss;
use Templates\InlinedJs;

/**
 * 
 */
class Home extends View
{
    /**
     * Define defaults, take arguments
     */
    public function __construct(array $args = [])
    {
        $defaults = [
            'row_count' => 12,
            'col_count' => 12,
        ];
        $this->args = array_replace($defaults, $args);
    }
    /**
     * todo
     *   - [ ] Build from data
     */
    public function compose(): self
    {

        $this->components['css'] = [
            new InlinedCss(['css/style.min.css'])
        ];

        $this->components['nav'] = [
            new Nav([
                'Home' => 'index.php?controller=Home',
                'Add Patient' => '?controller=Patient&action=Add',
                'List Patient' => '?controller=Patient&action=List',
                'Schedule' => '?controller=Patient&action=List',
            ])
        ];

        $this->components['content'] = [
            new InlinedCss(['css/Checkerboard.min.css']),
            new InlinedJs(['js/Checkerboard.min.js']),
            new Checkerboard(
                intval($this->args['row_count']),
                intval($this->args['col_count'])
            ),
            new Image('resources/images/cross.svg', 'a red cross'),
            new Image('resources/images/cross.svg', 'a red cross', 64, 64),
            new Image('resources/images/cross.svg', 'a red cross', 128, 128),
            // new Image(
            //     'resources/images/large-dummy-img.png',
            //     'this should take some time to load',
            //     480,
            //     270
            // ),
        ];


        $this->components['footer'] = [
            new Footer([
                '1x1' => '?controller=Home&action=value&row_count=1&col_count=1',
                '3x3' => '?controller=Home&action=value&row_count=3&col_count=3',
                '6x6' => '?controller=Home&action=value&row_count=6&col_count=6',
                '12x12' => '?controller=Home&action=value&row_count=12&col_count=12',
            ])
        ];
        return $this;
    }
}
