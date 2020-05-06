<?php

/**
 * 
 */

declare(strict_types=1);

namespace Models;

use Exception;
use Helpers\DBConfig;

/**
 * 
 */
class MinichatAPI extends DBPDO
{
    public function opGET()
    {
        $this->controller->set(['status_code' => 405]);
        // $this->args['status_code'] = 405;
        return ['Fetch : not implemented yet'];
    }
}
