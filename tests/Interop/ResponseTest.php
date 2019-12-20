<?php

namespace Zapheus\Bridge\Psr\Interop;

use Zapheus\Http\Message\Response as ZapheusResponse;

/**
 * Response Test
 *
 * @package Zapheus
 * @author  Rougin Gutib <rougingutib@gmail.com>
 */
class ResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var array
     */
    protected $files = array('file' => array());

    /**
     * @var \Zapheus\Http\Message\ResponseInterface
     */
    protected $response;

    /**
     * @var array
     */
    protected $server = array();

    /**
     * Sets up the response instance.
     *
     * @return void
     */
    public function setUp()
    {
        $response = new ZapheusResponse;

        $this->response = new Response($response);
    }

    /**
     * Tests ResponseInterface::getStatusCode.
     *
     * @return void
     */
    public function testGetStatusCodeMethod()
    {
        $expected = 404;

        $response = $this->response->withStatus($expected);

        $result = $response->getStatusCode();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests ResponseInterface::getReasonPhrase.
     *
     * @return void
     */
    public function testGetReasonPhraseMethod()
    {
        $expected = 'Proxy Authentication Required';

        $response = $this->response->withStatus(407);

        $result = $response->getReasonPhrase();

        $this->assertEquals($expected, $result);
    }
}
