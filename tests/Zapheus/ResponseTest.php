<?php

namespace Zapheus\Bridge\Psr\Zapheus;

use Zapheus\Bridge\Psr\Response as PsrResponse;
use Zapheus\Http\Message\ResponseFactory;

/**
 * Response Test
 *
 * @package Zapheus
 * @author  Rougin Gutib <rougingutib@gmail.com>
 */
class ResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Zapheus\Http\Message\ResponseFactory
     */
    protected $factory;

    /**
     * Sets up the response instance.
     *
     * @return void
     */
    public function setUp()
    {
        $response = new Response($psr = new PsrResponse);

        $this->factory = new ResponseFactory($response);
    }

    /**
     * Tests ResponseInterface::code.
     *
     * @return void
     */
    public function testCodeMethod()
    {
        $expected = 404;

        $factory = $this->factory->code($expected);

        $result = $factory->make()->code();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests ResponseInterface::reason.
     *
     * @return void
     */
    public function testReasonMethod()
    {
        $expected = 'Proxy Authentication Required';

        $factory = $this->factory->code(407);

        $result = $factory->make()->reason();

        $this->assertEquals($expected, $result);
    }
}
