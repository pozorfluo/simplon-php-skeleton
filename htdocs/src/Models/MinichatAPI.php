<?php

/**
 * 
 */

declare(strict_types=1);

namespace Models;

use Exception;
use Helpers\DBConfig;

/**
 * Serve Minichat RESTish API
 *   -> json
 * 
 * note
 *   Prepend all model modes of operation meant to be callable by a request
 *   with 'op'
 *   
 *   Forbid model method name starting with 'op' before prepending wether
 *   it is meant to be callable by a request or not
 *   
 *   e.g.,
 *     operate() is FORBIDDEN  
 *       -> could be requested maliciously with a request for 'erate'
 *     open() is FORBIDDEN  
 *       -> could be requested maliciously with a request for 'en'
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
