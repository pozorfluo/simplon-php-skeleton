<?php

/**
 * 
 */

declare(strict_types=1);

namespace Controllers;

use Models\Model;

/**
 * 
 */
abstract class MinichatAPI extends API
{
    public function __construct(array $args = [])
    {
        parent::__construct($args);

        echo '<pre>new MinichatAPI ()</pre>';

        echo '<pre>'.var_export($args, true).'</pre><hr />';
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
     *   Prepend all model modes of operation meant to be callable by a request
     *   with 'op'
     */
    public function runDefault(array $args = []): void
    {
            /* 'escaping' and providing default action */
            $this->args['method'] =
                'op' . ($this->args['action'] ?? 'Fetch');

            /* use existing model or load one */
            if (method_exists(
                $this->model ?? $this->loadModel(),
                $this->request['method']
            )) {
                /* requested mode of operation exists, run it */
                $this->model->{$this->args['method']}($this);
            } else {
                /* mode of operation does NOT exist on this endpoint */
                $this->emit(['no can do'], 405);
            }
}
