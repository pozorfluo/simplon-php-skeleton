<?php

/**
 * 
 */

declare(strict_types=1);

namespace Models;

use Exception;
use Helpers\DBConfig;

/**
 * Minichat RESTish API
 *   -> set status_code
 *   -> set data
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
     * Return last few messages
     *
     * todo
     *   - [ ] Translate PDO/MySQL errors into meaningful response for the
     *         RESTish API
     *   - [ ] Add a json cache/buffer
     */
    public function opGET(int $msg_count = 5): ?array
    {
        try {
            $results = $this->execute(
                'minichat',
                "SELECT
                    `messages`.`created_at`,
                    `users`.`nickname`,
                    `messages`.`message`
                 FROM
                    `messages`
                 INNER JOIN `users` ON `messages`.`user_id` = `users`.`id`
                 ORDER BY
                    `messages`.`created_at` ASC
                 LIMIT 
                    ?",
                [$msg_count]
            );

            if (empty($results)) {
                /* No Content */
                $this->controller->set(['status_code' => 204]);
            } else {
                /* OK */
                $this->controller->set(['status_code' => 200]);
            }
            $this->controller->set(['data' => $results]);
            return $results;
        } catch (Exception $e) {
            /**
             * todo
             *   - [ ] Have a look at PDO statement errorInfo()
             */
            /* Internal Server Error */
            $this->controller->set(['status_code' => 500]);
            return $e->getMessage();
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
