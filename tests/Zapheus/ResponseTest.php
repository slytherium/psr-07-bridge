<?php

namespace Zapheus\Bridge\Psr\Zapheus;

use Zapheus\Bridge\Psr\Response as PsrResponse;

/**
 * Response Test
 *
 * @package Zapheus
 * @author  Rougin Royce Gutib <rougingutib@gmail.com>
 */
class ResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Zapheus\Http\Message\ResponseInterface
     */
    protected $response;

    /**
     * Sets up the response instance.
     *
     * @return void
     */
    public function setUp()
    {
        $response = new PsrResponse;

        $this->response = new Response($response);
    }

    /**
     * Tests ResponseInterface::code.
     *
     * @return void
     */
    public function testCodeMethod()
    {
        $expected = 404;

        $response = $this->response->with('code', $expected);

        $result = $response->code();

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

        $response = $this->response->with('code', 407);

        $result = $response->reason();

        $this->assertEquals($expected, $result);
    }
}
