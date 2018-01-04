<?php

namespace Zapheus\Bridge\Psr;

use Zapheus\Http\Message\UploadedFile;
use Zapheus\Http\Message\Uri;
use Zend\Diactoros\ServerRequestFactory;
use Zend\Diactoros\UploadedFile as File;

/**
 * Server Request Test
 *
 * @package Slytherin
 * @author  Rougin Royce Gutib <rougingutib@gmail.com>
 */
class ServerRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var array
     */
    protected $files = array('file' => array());

    /**
     * @var \Zapheus\Http\Message\ServerRequestInterface
     */
    protected $request;

    /**
     * @var array
     */
    protected $server = array();

    /**
     * Sets up the request instance.
     *
     * @return void
     */
    public function setUp()
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/';
        $_SERVER['SERVER_NAME'] = 'rougin.github.io';
        $_SERVER['SERVER_PORT'] = 8000;

        $_FILES['file']['error'] = array(0);
        $_FILES['file']['name'] = array('test.txt');
        $_FILES['file']['size'] = array(100);
        $_FILES['file']['tmp_name'] = array('/tmp/test.txt');
        $_FILES['file']['type'] = array('text/plain');

        $request = ServerRequestFactory::fromGlobals();

        $this->server = $request->getServerParams();

        $this->request = new ServerRequest($request);
    }

    /**
     * Tests ServerRequestInterface::getAttribute.
     *
     * @return void
     */
    public function testGetAttributeMethod()
    {
        $expected = 'Rougin Royce';

        $request = $this->request->withAttribute('name', $expected);

        $result = $request->getAttribute('name');

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests ServerRequestInterface::getAttributes.
     *
     * @return void
     */
    public function testGetAttributesMethod()
    {
        $expected = array('name' => 'Rougin Royce');

        $request = $this->request->withAttribute('name', 'Rougin Royce');

        $result = $request->getAttributes();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests ServerRequestInterface::getCookieParams.
     *
     * @return void
     */
    public function testGetCookieParamsMethod()
    {
        $expected = array('name' => 'Rougin', 'address' => 'Tomorrowland');

        $request = $this->request->withCookieParams($expected);

        $result = $request->getCookieParams();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests ServerRequestInterface::getParsedBody.
     *
     * @return void
     */
    public function testGetParsedBodyMethod()
    {
        $expected = array('name' => 'Rougin Royce', 'age' => 20);

        $request = $this->request->withParsedBody($expected);

        $result = $request->getParsedBody();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests ServerRequestInterface::getQueryParams.
     *
     * @return void
     */
    public function testGetQueryParamsMethod()
    {
        $expected = array('name' => 'Rougin Royce', 'age' => 20);

        $request = $this->request->withQueryParams($expected);

        $result = $request->getQueryParams();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests ServerRequestInterface::getStatusCode.
     *
     * @return void
     */
    public function testGetStatusCodeMethod()
    {
        $expected = $this->server;

        $result = $this->request->getServerParams();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests ServerRequestInterface::getUploadedFiles.
     *
     * @return void
     */
    public function testGetUploadedFilesMethod()
    {
        $file = new UploadedFile('/test.txt', 0, 0, 'test.txt', 'text/plain');

        $expected = array($file);

        $request = $this->request->withUploadedFiles(array($file));

        $result = $request->getUploadedFiles();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests ServerRequestInterface::withoutAttribute.
     *
     * @return void
     */
    public function testWithoutAttributeMethod()
    {
        $request = $this->request->withoutAttribute('REQUEST_METHOD');

        $this->assertNull($request->getAttribute('REQUEST_METHOD'));
    }

    /**
     * Tests RequestInterface::getRequestTarget.
     *
     * @return void
     */
    public function testGetRequestTargetMethod()
    {
        $expected = 'origin-form';

        $request = $this->request->withRequestTarget($expected);

        $result = $request->getRequestTarget();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests RequestInterface::getMethod.
     *
     * @return void
     */
    public function testGetMethodMethod()
    {
        $expected = 'POST';

        $request = $this->request->withMethod($expected);

        $result = $request->getMethod();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests MessageInterface::getUri.
     *
     * @return void
     */
    public function testGetUriMethod()
    {
        $expected = new Uri('https://rougin.github.io');

        $request = $this->request->withUri($expected);

        $result = $request->getUri();

        $this->assertEquals($expected, $result);
    }
}
