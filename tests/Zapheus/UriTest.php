<?php

namespace Zapheus\Bridge\Psr\Zapheus;

use Zapheus\Bridge\Psr\Uri as PsrUri;

/**
 * Uri Test
 *
 * @package Zapheus
 * @author  Rougin Gutib <rougingutib@gmail.com>
 */
class UriTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Psr\Http\Message\UriInterface
     */
    protected $psr;

    /**
     * @var \Zapheus\Http\Message\UriInterface
     */
    protected $uri;

    /**
     * Sets up the URI instance.
     *
     * @return void
     */
    public function setUp()
    {
        $url = 'https://me@roug.in:400/about#test';

        $psr = new PsrUri($url);

        $this->uri = new Uri($this->psr = $psr);
    }

    /**
     * Tests UriInterface::__toString.
     *
     * @return void
     */
    public function testToStringMagicMethod()
    {
        $expected = 'https://me@roug.in:400/about#test';

        $this->assertEquals($expected, (string) $this->uri);
    }

    /**
     * Tests UriInterface::getAuthority.
     *
     * @return void
     */
    public function testGetAuthorityMethod()
    {
        $expected = 'me@roug.in:400';

        $result = $this->uri->authority();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests UriInterface::getFragment.
     *
     * @return void
     */
    public function testGetFragmentMethod()
    {
        $expected = $this->psr->getFragment();

        $result = $this->uri->fragment();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests UriInterface::getHost.
     *
     * @return void
     */
    public function testGetHostMethod()
    {
        $expected = $this->psr->getHost();

        $result = $this->uri->host();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests UriInterface::getPath.
     *
     * @return void
     */
    public function testGetPathMethod()
    {
        $expected = $this->psr->getPath();

        $result = $this->uri->path();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests UriInterface::getPort.
     *
     * @return void
     */
    public function testGetPortMethod()
    {
        $expected = $this->psr->getPort();

        $result = $this->uri->port();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests UriInterface::getQuery.
     *
     * @return void
     */
    public function testGetQueryMethod()
    {
        $expected = $this->psr->getQuery();

        $result = $this->uri->query();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests UriInterface::getScheme.
     *
     * @return void
     */
    public function testGetSchemeMethod()
    {
        $expected = $this->psr->getScheme();

        $result = $this->uri->scheme();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests UriInterface::getUserInfo.
     *
     * @return void
     */
    public function testGetUserInfoMethod()
    {
        $expected = $this->psr->getUserInfo();

        $result = $this->uri->user();

        $this->assertEquals($expected, $result);
    }
}
