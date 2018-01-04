<?php

namespace Zapheus\Bridge\Psr07;

use Psr\Http\Message\ResponseInterface;

/**
 * PSR-07 to Zapheus Response Bridge
 *
 * @package Zapheus
 * @author  Rougin Royce Gutib <rougingutib@gmail.com>
 */
class Response extends \Zapheus\Http\Message\Response
{
    /**
     * Initializes the server request instance.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        $body = new Stream($response->getBody());

        $code = $response->getStatusCode();

        $headers = $response->getHeaders();

        $version = $response->getProtocolVersion();

        parent::__construct($code, $body, $headers, $version);
    }
}
