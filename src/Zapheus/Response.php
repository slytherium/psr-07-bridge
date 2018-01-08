<?php

namespace Zapheus\Bridge\Psr\Zapheus;

use Psr\Http\Message\ResponseInterface;
use Zapheus\Http\Message\Response as ZapheusResponse;

/**
 * PSR-07 to Zapheus Response Bridge
 *
 * @package Zapheus
 * @author  Rougin Royce Gutib <rougingutib@gmail.com>
 */
class Response extends ZapheusResponse
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

        $version = $response->getProtocolVersion();

        $headers = $response->getHeaders();

        parent::__construct($code, $body, $headers, $version);
    }
}
