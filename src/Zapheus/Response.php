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
     * Initializes the response instance.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        parent::__construct((integer) $response->getStatusCode());

        $this->set('headers', $response->getHeaders());

        $this->set('stream', new Stream($response->getBody()));

        $this->set('version', $response->getProtocolVersion());
    }
}
