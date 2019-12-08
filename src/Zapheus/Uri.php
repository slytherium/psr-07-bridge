<?php

namespace Zapheus\Bridge\Psr\Zapheus;

use Psr\Http\Message\UriInterface;
use Zapheus\Http\Message\Uri as BaseUri;
use Zapheus\Http\Message\UriInterface as ZapheusUriInterface;

/**
 * PSR-07 to Zapheus URI Bridge
 *
 * @package Zapheus
 * @author  Rougin Royce Gutib <rougingutib@gmail.com>
 */
class Uri extends BaseUri implements ZapheusUriInterface
{
    /**
     * @var string
     */
    protected $authority;

    /**
     * Initializes the URI instance.
     *
     * @param \Psr\Http\Message\UriInterface $uri
     */
    public function __construct(UriInterface $uri)
    {
        $this->fragment = $uri->getFragment();

        $this->query = $uri->getQuery();

        $this->authority = $uri->getAuthority();

        $this->host = $uri->getHost();

        $this->path = $uri->getPath();

        $this->port = $uri->getPort();

        $this->scheme = $uri->getScheme();

        $this->user = $uri->getUserInfo();

        $this->uri = $uri->__toString();
    }
}
