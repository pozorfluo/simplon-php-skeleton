<?php

/**
 * 
 */

declare(strict_types=1);

namespace Controllers;

use Models\Model;

/**
 *   RESTish API setup
 *     Use the request method to define the mode of operation for this
 *     endpoint
 *   
 *     Controller       -> API
 *     Action           -> endpoint
 *     Request Method   -> mode of operation
 *     Other Parameters -> query parameters
 *     
 *     Mode of operation
 *       GET    -> fetch
 *       POST   -> add
 *       PUT    -> update/edit
 *       DELETE -> remove
 * 
 *     Prepend mode of operation method names with 'op' to make it clear 
 *     what is meant to be a callable action and thwart some malicious 
 *     requests
 *       e.g.,
 *         opFetch()
 *         opAdd()
 *         opUpdate()
 *         opRemove()
 */
abstract class API extends Controller
{
    public function __construct(array $args = [])
    {
        parent::__construct($args);

        
        /**
         * todo
         *   - [ ] Allow and handle CORS
         *     + [ ] Implement some kind of API key checking
         *   - [ ] Implement Auth
         */
        // header('Access-Control-Allow-Origin: *');
        // header('Access-Control-Allow-Methods: *');
        
        header('Content-Type: application/json');
        // echo '<pre>new API ()</pre>';
    }
    
    /**
     * Return the status string for a given status code
     *   1xx Informational
     *   2xx Success
     *   3xx Redirection 
     *   4xx Client Error
     *   5xx Server Error 
     */
    public static function status(int $code): string
    {
        $status   = [
            '100' => 'Continue',
            '101' => 'Switching Protocols',
            '200' => 'OK',
            '201' => 'Created',
            '202' => 'Accepted',
            '203' => 'Non-Authoritative Information',
            '204' => 'No Content',
            '205' => 'Reset Content',
            '206' => 'Partial Content',
            '300' => 'Multiple Choices',
            '301' => 'Moved Permanently',
            '302' => 'Found',
            '303' => 'See Other',
            '304' => 'Not Modified',
            '305' => 'Use Proxy',
            '307' => 'Temporary Redirect',
            '400' => 'Bad Request',
            '401' => 'Unauthorized',
            '402' => 'Payment Required',
            '403' => 'Forbidden',
            '404' => 'Not Found',
            '405' => 'Method Not Allowed',
            '406' => 'Not Acceptable',
            '407' => 'Proxy Authentication Required',
            '408' => 'Request Time-out',
            '409' => 'Conflict',
            '410' => 'Gone',
            '411' => 'Length Required',
            '412' => 'Precondition Failed',
            '413' => 'Request Entity Too Large',
            '414' => 'Request-URI Too Large',
            '415' => 'Unsupported Media Type',
            '416' => 'Requested range not satisfiable',
            '417' => 'Expectation Failed',
            '500' => 'Internal Server Error',
            '501' => 'Not Implemented',
            '502' => 'Bad Gateway',
            '503' => 'Service Unavailable',
            '504' => 'Gateway Time-out',
            '505' => 'HTTP Version not supported'
        ];
        return $status[$code] ?? $status[500];
    }

    /**
     * 
     */
    private function emit(array $data, int $status_code): self
    {
        $status = self::status($status_code);
        header("HTTP/1.1 {$status_code} {$status}");

        /* keep it around for optional caching */
        $this->rendered_page = json_encode($data);

        echo $this->rendered_page;

        return $this;
    }
    /**
     * note
     *   Prepend all model mode of operation meant to be callable by a request
     *   with 'op'
     */
    abstract public function runDefault(array $args);
}
