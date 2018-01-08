<?php

namespace Zapheus\Bridge\Psr\Zapheus;

use Psr\Http\Message\UriInterface;
use Zapheus\Bridge\Psr\Interop\Uri as AbstractUri;
use Zapheus\Http\Message\UriInterface as ZapheusUriInterface;

/**
 * PSR-07 to Zapheus URI Bridge
 *
 * @package Zapheus
 * @author  Rougin Royce Gutib <rougingutib@gmail.com>
 */
class Uri extends AbstractUri implements ZapheusUriInterface
{
    /**
     * @var \Psr\Http\Message\UriInterface
     */
    protected $uri;

    /**
     * Initializes the URI instance.
     *
     * @param \Psr\Http\Message\UriInterface $uri
     */
    public function __construct(UriInterface $uri)
    {
        $this->uri = $uri;
    }
}
