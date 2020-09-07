<?php

namespace Zapheus\Bridge\Psr\Interop;

use Zapheus\Http\Message\Uri as ZapheusUri;

/**
 * Uri Test
 *
 * @package Zapheus
 * @author  Rougin Gutib <rougingutib@gmail.com>
 */
class UriTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Zapheus\Http\Message\UriInterface
     */
    protected $zapheus;

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

        $zapheus = new ZapheusUri($url);

        $this->uri = new Uri($this->zapheus = $zapheus);
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

        $result = $this->uri->getAuthority();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests UriInterface::getFragment.
     *
     * @return void
     */
    public function testGetFragmentMethod()
    {
        $expected = $this->zapheus->fragment();

        $result = $this->uri->getFragment();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests UriInterface::withFragment.
     *
     * @return void
     */
    public function testWithFragmentMethod()
    {
        $expected = 'test';

        $uri = $this->uri->withFragment($expected);

        $result = $uri->getFragment();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests UriInterface::getHost.
     *
     * @return void
     */
    public function testGetHostMethod()
    {
        $expected = $this->zapheus->host();

        $result = $this->uri->getHost();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests UriInterface::withHost.
     *
     * @return void
     */
    public function testWithHostMethod()
    {
        $expected = 'roug.in';

        $uri = $this->uri->withHost($expected);

        $result = $uri->getHost();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests UriInterface::getPath.
     *
     * @return void
     */
    public function testGetPathMethod()
    {
        $expected = $this->zapheus->path();

        $result = $this->uri->getPath();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests UriInterface::withPath.
     *
     * @return void
     */
    public function testWithPathMethod()
    {
        $expected = '/test';

        $uri = $this->uri->withPath($expected);

        $result = $uri->getPath();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests UriInterface::getPort.
     *
     * @return void
     */
    public function testGetPortMethod()
    {
        $expected = $this->zapheus->port();

        $result = $this->uri->getPort();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests UriInterface::withPort.
     *
     * @return void
     */
    public function testWithPortMethod()
    {
        $expected = 500;

        $uri = $this->uri->withPort($expected);

        $result = $uri->getPort();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests UriInterface::getQuery.
     *
     * @return void
     */
    public function testGetQueryMethod()
    {
        $expected = $this->zapheus->query();

        $result = $this->uri->getQuery();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests UriInterface::withQuery.
     *
     * @return void
     */
    public function testWithQueryMethod()
    {
        $expected = 'type=user';

        $uri = $this->uri->withQuery($expected);

        $result = $uri->getQuery();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests UriInterface::getScheme.
     *
     * @return void
     */
    public function testGetSchemeMethod()
    {
        $expected = $this->zapheus->scheme();

        $result = $this->uri->getScheme();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests UriInterface::withScheme.
     *
     * @return void
     */
    public function testWithSchemeMethod()
    {
        $expected = 'http';

        $uri = $this->uri->withScheme($expected);

        $result = $uri->getScheme();

        $this->assertEquals('http', $result);
    }

    /**
     * Tests UriInterface::getUserInfo.
     *
     * @return void
     */
    public function testGetUserInfoMethod()
    {
        $expected = $this->zapheus->user();

        $result = $this->uri->getUserInfo();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests UriInterface::withUserInfo.
     *
     * @return void
     */
    public function testWithUserInfoMethod()
    {
        $expected = 'username:password';

        $uri = $this->uri->withUserInfo('username', 'password');

        $result = $uri->getUserInfo();

        $this->assertEquals($expected, $result);
    }
}
