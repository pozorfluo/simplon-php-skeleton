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
use Templates\Table;

/**
 *
 */
class PatientList extends View
{
    /**
     * Define defaults, take arguments
     */
    public function __construct(array $args = [])
    {
        $defaults = [
            'row_count' => 3,
            'col_count' => 3,
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
            new InlinedCss(['css/style.css'])
        ];

        $this->components['nav'] = [
            new Nav([
                'Home' => 'index.php?controller=Home',
                'List Patient' => '?controller=Patient&action=List',
                'Add Patient' => '?controller=Patient&action=Add',
                'Schedule' => '?controller=Patient&action=Schedule',
            ])
        ];

        $this->components['content'] = [
            new Table(array_fill(0, 10, array_fill(0, 8, '-'))),
            new Table(array_fill(0, 20, ['a' => '-', 'b' => '-', 'c' => '-', 'd' => '-'])),
        ];


        $this->components['footer'] = [
            new Footer([
                '1x1' => '?controller=Home&action=value&row_count=1&col_count=1',
                '3x3' => '?controller=Home&action=value&row_count=3&col_count=3',
                '6x6' => '?controller=Home&action=value&row_count=6&col_count=6',
                '12x12' => '?controller=Home&action=value&row_count=12&col_count=12',
            ]),
        ];

        // $object_comparison = $this->components['footer'][2] == $this->components['nav'][0];
        // echo '<pre>'.var_export($object_comparison, true).'</pre>';

        return $this;
    }
}
