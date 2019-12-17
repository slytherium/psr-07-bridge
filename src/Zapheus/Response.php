<?php

namespace Zapheus\Bridge\Psr\Zapheus;

use Psr\Http\Message\ResponseInterface;
use Zapheus\Http\Message\Response as ZapheusResponse;

/**
 * PSR-07 to Zapheus Response Bridge
 *
 * @package Zapheus
 * @author  Rougin Gutib <rougingutib@gmail.com>
 */
class Response extends ZapheusResponse
{
    /**
     * Initializes the response instance.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        $this->code = $response->getStatusCode();

        $this->headers = $response->getHeaders();

        $this->stream = new Stream($response->getBody());

        $this->version = $response->getProtocolVersion();
    }
}
