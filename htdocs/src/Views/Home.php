<?php

/**
 * 
 */

declare(strict_types=1);

namespace Views;

use Templates\InlinedCss;
use Templates\Nav as Nav;
use Templates\Footer;
use Templates\PatientForm as PatientForm;

/**
 * 
 */
class Home extends View
{
    /**
     * Render components
     *   -> [string name => string rendered component]
     */
    public function render(): array
    {
        foreach($this->components as $key => $value ){
            $this->components[$key] = $value->render();
        }
        return $this->components;
    }

    /**
     * todo
     *   - [ ] Build from data
     */
    public function compose(): self
    {
        $this->components['css'] = new InlinedCss(['css/style.css']);

        $this->components['nav'] = new Nav([
            'Home' => 'index.php?controller=Home',
            'Add Patient' => 'index.php?controller=Patient&action=Add',
            'List Patient' => 'index.php?controller=Patient&action=List',
            'Schedule' => 'index.php?controller=Patient&action=List',
        ]);
        $this->components['footer'] = new Footer([
            'Home' => 'index.php?controller=Home',
        ]);
        return $this;
    }


}
