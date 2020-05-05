<?php

/**
 * 
 */

declare(strict_types=1);

namespace Views;

use Controllers\Controller;
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
    public function __construct(Controller $controller)
    {
        parent::__construct($controller);
        $defaults = [
            'id' => '',
            'action' => '?controller=Patient&action=Add',
            'submit' => 'Add Patient'
        ];
        $this->args = array_replace($defaults, $this->args);

        /**
         * todo
         *   - [ ] Decide  or Controller if View takes care of user input
         *     + [ ] Do what seems to split the load in a convenient way, 
         *           litterature is full of messy opinions
         *     + [ ] Try in the View, keep 'massaging and displaying' tight
         *           and close together !
         *       
         */
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
                'List Patient' => '?controller=Patient&action=List',
                'Add Patient' => '?controller=Patient&action=Add',
                'Schedule' => '?controller=Patient&action=Schedule',
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
