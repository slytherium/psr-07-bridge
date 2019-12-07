<?php

namespace Zapheus\Bridge\Psr\Interop;

use Psr\Http\Message\UriInterface as PsrUriInterface;
use Zapheus\Bridge\Psr\Uri as BaseUri;
use Zapheus\Http\Message\UriInterface;

/**
 * Zapheus to PSR-07 URI Bridge
 *
 * @package Zapheus
 * @author  Rougin Gutib <rougingutib@gmail.com>
 */
class Uri extends BaseUri implements PsrUriInterface
{
    /**
     * Initializes the URI instance.
     *
     * @param \Zapheus\Http\Message\UriInterface $uri
     */
    public function __construct(UriInterface $uri)
    {
        $this->fragment = $uri->fragment();

        $this->host = $uri->host();

        $this->path = $uri->path();

        $this->port = $uri->port();

        $this->query = $uri->query();

        $this->scheme = $uri->scheme();

        $this->uri = $uri->__toString();

        $this->user = $uri->user();
    }
}
