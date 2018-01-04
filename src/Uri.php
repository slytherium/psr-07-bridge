<?php

namespace Zapheus\Bridge\Psr07;

use Psr\Http\Message\UriInterface;

/**
 * PSR-07 to Zapheus URI Bridge
 *
 * @package Zapheus
 * @author  Rougin Royce Gutib <rougingutib@gmail.com>
 */
class Uri implements \Zapheus\Http\Message\UriInterface
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
     * Retrieve the authority component of the URI.
     *
     * @return string
     */
    public function getAuthority()
    {
        return $this->uri->getAuthority();
    }

    /**
     * Retrieve the fragment component of the URI.
     *
     * @return string
     */
    public function getFragment()
    {
        return $this->uri->getFragment();
    }

    /**
     * Retrieve the host component of the URI.
     *
     * @return string
     */
    public function getHost()
    {
        return $this->uri->getHost();
    }

    /**
     * Retrieve the path component of the URI.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->uri->getPath();
    }

    /**
     * Retrieve the port component of the URI.
     *
     * @return null|integer
     */
    public function getPort()
    {
        return $this->uri->getPort();
    }

    /**
     * Retrieve the query string of the URI.
     *
     * @return string
     */
    public function getQuery()
    {
        return $this->uri->getQuery();
    }

    /**
     * Retrieve the scheme component of the URI.
     *
     * @return string
     */
    public function getScheme()
    {
        return $this->uri->getScheme();
    }

    /**
     * Retrieve the user information component of the URI.
     *
     * @return string
     */
    public function getUserInfo()
    {
        return $this->uri->getUserInfo();
    }

    /**
     * Return an instance with the specified URI fragment.
     *
     * @param  string $fragment
     * @return static
     */
    public function withFragment($fragment)
    {
        return $this->uri->withFragment($fragment);
    }

    /**
     * Return an instance with the specified host.
     *
     * @param  string $host
     * @return static
     *
     * @throws \InvalidArgumentException
     */
    public function withHost($host)
    {
        return $this->uri->withHost($host);
    }

    /**
     * Return an instance with the specified path.
     *
     * @param  string $path
     * @return static
     *
     * @throws \InvalidArgumentException
     */
    public function withPath($path)
    {
        return $this->uri->withPath($path);
    }

    /**
     * Return an instance with the specified port.
     *
     * @param  null|integer $port
     * @return static
     *
     * @throws \InvalidArgumentException
     */
    public function withPort($port)
    {
        return $this->uri->withPort($port);
    }

    /**
     * Return an instance with the specified query string.
     *
     * @param  string $query
     * @return static
     *
     * @throws \InvalidArgumentException
     */
    public function withQuery($query)
    {
        return $this->uri->withQuery($query);
    }

    /**
     * Return an instance with the specified scheme.
     *
     * @param  string $scheme
     * @return static
     *
     * @throws \InvalidArgumentException
     */
    public function withScheme($scheme)
    {
        return $this->uri->withScheme($scheme);
    }

    /**
     * Return an instance with the specified user information.
     *
     * @param  string      $user
     * @param  null|string $password
     * @return static
     */
    public function withUserInfo($user, $password = null)
    {
        return $this->uri->withUserInfo($user, $password);
    }
}
