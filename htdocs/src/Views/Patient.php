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
use Templates\PatientForm;

/**
 *
 */
class Patient extends View
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
                'Add Patient' => '?controller=Patient&action=Add',
                'List Patient' => '?controller=Patient&action=List',
                'Schedule' => '?controller=Patient&action=List',
            ])
        ];

        $this->components['content'] = [
            new PatientForm(new \Entities\Patient(), '', 'Add Patient')
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
