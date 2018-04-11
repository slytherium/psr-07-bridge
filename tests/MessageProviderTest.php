<?php

namespace Zapheus\Bridge\Psr;

use Zapheus\Container\Container;
use Zapheus\Http\Message\Request;
use Zapheus\Http\Message\Response;

/**
 * Message Provider Test
 *
 * @package Zapheus
 * @author  Rougin Royce Gutib <rougingutib@gmail.com>
 */
class MessageProviderTest extends \PHPUnit_Framework_TestCase
{
    const PSR_REQUEST = 'Psr\Http\Message\ServerRequestInterface';

    const PSR_RESPONSE = 'Psr\Http\Message\ResponseInterface';

    const ZAPHEUS_REQUEST = 'Zapheus\Http\Message\RequestInterface';

    const ZAPHEUS_RESPONSE = 'Zapheus\Http\Message\ResponseInterface';

    /**
     * @var \Zapheus\Container\WritableInterface
     */
    protected $container;

    /**
     * @var \Zapheus\Provider\ProviderInterface
     */
    protected $provider;

    /**
     * Sets up the provider instance.
     *
     * @return void
     */
    public function setUp()
    {
        $this->container = new Container;

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/';
        $_SERVER['SERVER_NAME'] = 'rougin.github.io';
        $_SERVER['SERVER_PORT'] = 8000;

        $request = new Request($_SERVER);

        $this->container->set(self::ZAPHEUS_REQUEST, $request);

        $response = new Response;

        $this->container->set(self::ZAPHEUS_RESPONSE, $response);

        $this->provider = new MessageProvider;
    }

    /**
     * Tests ProviderInterface::register.
     *
     * @return void
     */
    public function testRegisterMethod()
    {
        $container = $this->provider->register($this->container);

        $expected = $container->get(self::PSR_REQUEST);

        $this->assertInstanceOf(self::PSR_REQUEST, $expected);

        $expected = $container->get(self::PSR_RESPONSE);

        $this->assertInstanceOf(self::PSR_RESPONSE, $expected);
    }
}
