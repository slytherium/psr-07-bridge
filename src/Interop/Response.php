<?php

namespace Zapheus\Bridge\Psr\Interop;

use Zapheus\Bridge\Psr\Response as PsrResponse;
use Zapheus\Http\Message\ResponseInterface;

/**
 * Zapheus to PSR-07 Response Bridge
 *
 * @package Zapheus
 * @author  Rougin Royce Gutib <rougingutib@gmail.com>
 */
class Response extends PsrResponse
{
    /**
     * Initializes the server request instance.
     *
     * @param \Zapheus\Http\Message\ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        $body = new Stream($response->stream());

        $code = $response->code();

        $version = $response->version();

        $headers = $response->headers()->all();

        parent::__construct($code, $body, $headers, $version);
    }
}
