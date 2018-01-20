<?php

namespace Zapheus\Bridge\Psr\Zapheus;

use Psr\Http\Message\UriInterface;
use Zapheus\Http\Message\Uri as AbstractUri;
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

    /**
     * Return the string representation as a URI reference.
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->uri;
    }

    /**
     * Returns the authority component of the URI.
     *
     * @return string
     */
    public function authority()
    {
        return $this->uri->getAuthority();
    }

    /**
     * Returns the fragment component of the URI.
     *
     * @return string
     */
    public function fragment()
    {
        return $this->uri->getFragment();
    }

    /**
     * Returns the host component of the URI.
     *
     * @return string
     */
    public function host()
    {
        return $this->uri->getHost();
    }

    /**
     * Returns the path component of the URI.
     *
     * @return string
     */
    public function path()
    {
        return $this->uri->getPath();
    }

    /**
     * Returns the port component of the URI.
     *
     * @return null|integer
     */
    public function port()
    {
        return $this->uri->getPort();
    }

    /**
     * Returns the query string of the URI.
     *
     * @return string
     */
    public function query()
    {
        return $this->uri->getQuery();
    }

    /**
     * Returns the scheme component of the URI.
     *
     * @return string
     */
    public function scheme()
    {
        return $this->uri->getScheme();
    }

    /**
     * Returns the user information component of the URI.
     *
     * @return string
     */
    public function user()
    {
        return $this->uri->getUserInfo();
    }
}
