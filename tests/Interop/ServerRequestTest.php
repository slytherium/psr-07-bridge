<?php

namespace Zapheus\Bridge\Psr\Interop;

use Zapheus\Bridge\Psr\UploadedFile;
use Zapheus\Bridge\Psr\Uri;
use Zapheus\Http\Message\FileFactory;
use Zapheus\Http\Message\RequestFactory;
use Zapheus\Http\Message\Stream as ZapheusStream;

/**
 * Server Request Test
 *
 * @package Zapheus
 * @author  Rougin Gutib <rougingutib@gmail.com>
 */
class ServerRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var array
     */
    protected $files = array('file' => array());

    /**
     * @var \Psr\Http\Message\ServerRequestInterface
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
        $_SERVER['SERVER_NAME'] = 'roug.in';
        $_SERVER['SERVER_PORT'] = 8000;

        $file = __DIR__ . '/../Fixture/Views/HelloWorld.php';

        $_FILES['file']['error'] = array(0);
        $_FILES['file']['name'] = array(basename($file));
        $_FILES['file']['size'] = array(filesize($file));
        $_FILES['file']['tmp_name'] = array($file);
        $_FILES['file']['type'] = array(mime_content_type($file));

        $factory = new FileFactory;

        $files = $factory->normalize($_FILES);

        $factory = new RequestFactory;

        $factory->server($_SERVER);

        $request = $factory->files($files)->make();

        $this->server = $request->server();

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
     * Tests ServerRequestInterface::getServerParams.
     *
     * @return void
     */
    public function testGetServerParamsMethod()
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
     * Tests ServerRequestInterface::getUri.
     *
     * @return void
     */
    public function testGetUriMethod()
    {
        $expected = new Uri('https://roug.in');

        $request = $this->request->withUri($expected);

        $result = $request->getUri();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests ServerRequestInterface::getBody with another stream instance.
     *
     * @return void
     */
    public function testGetBodyMethodWithAnotherStreamInstance()
    {
        $zapheus = new ZapheusStream(fopen('php://temp', 'r+'));

        $stream = new Stream($zapheus);

        $stream->write('Hello, world');

        $message = $this->request->withBody($stream);

        $expected = (string) $stream;

        $result = (string) $message->getBody();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests ServerRequestInterface::getHeader.
     *
     * @return void
     */
    public function testGetHeaderMethod()
    {
        $request = $this->request->withHeader('name', 'Rougin');

        $expected = array('Rougin');

        $result = $request->getHeader('name');

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests ServerRequestInterface::getHeaderLine.
     *
     * @return void
     */
    public function testGetHeaderLineMethod()
    {
        $names = array('Rougin', 'Royce');

        $request = $this->request->withHeader('names', $names);

        $expected = 'Rougin,Royce';

        $result = $request->getHeaderLine('names');

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests ServerRequestInterface::getHeaders.
     *
     * @return void
     */
    public function testGetHeadersMethod()
    {
        $names = array('Rougin', 'Royce');

        $request = $this->request->withHeader('names', $names);

        $expected = array('names' => $names);

        $result = $request->getHeaders();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests ServerRequestInterface::withAddedHeader.
     *
     * @return void
     */
    public function testWithAddedHeaderMethod()
    {
        $request = $this->request->withHeader('name', 'Rougin');

        $request = $request->withAddedHeader('name', 'Royce');

        $expected = array('Rougin', 'Royce');

        $result = $request->getHeader('name');

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests ServerRequestInterface::getProtocolVersion.
     *
     * @return void
     */
    public function testGetProtocolVersionMethod()
    {
        $expected = '2.0';

        $request = $this->request->withProtocolVersion($expected);

        $result = $request->getProtocolVersion();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests ServerRequestInterface::withoutHeader.
     *
     * @return void
     */
    public function testWithoutHeaderMethod()
    {
        $request = $this->request->withHeader('name', 'Rougin');

        $request = $request->withAddedHeader('framework', 'Zapheus');

        $request = $request->withoutHeader('name');

        $this->assertFalse($request->hasHeader('name'));
    }
}
