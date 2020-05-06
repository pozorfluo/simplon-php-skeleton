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
    /**
     * todo
     *   - [ ] Translate PDO/MySQL errors into meaningful response for the
     *         RESTish API
     */
    public function opGET() :array
    {
        try {
            $results = $this->execute(
                'patients',
                "SELECT
                    *
                FROM 
                    `patients`;"
            );
            if (empty($results)) {
                $this->controller->set(['status_code' => 204]);
            } else {
                $this->controller->set(['status_code' => 200]);
            }
            $this->controller->set(['data' => $results]);
            return [$results];
        } catch (Exception $e) {
            /**
             * todo
             *   - [ ] Have a look at PDO statement errorInfo()
             */
            return [$e->getMessage()];
        }
    }

    /**
     * 
     */
    public function opPOST()
    {
        $this->controller->set(['status_code' => 405]);
        // $this->args['status_code'] = 405;
        return ['POST : not implemented yet'];
    }

    /**
     *
     */
    public function opPUT()
    {
        $this->controller->set(['status_code' => 405]);
        // $this->args['status_code'] = 405;
        return ['PUT : not implemented yet'];
    }

    /**
     * 
     */
    public function opDELETE()
    {
        $this->controller->set(['status_code' => 405]);
        // $this->args['status_code'] = 405;
        return ['DELETE : not implemented yet'];
    }
}
