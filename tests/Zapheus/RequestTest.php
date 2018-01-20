<?php

namespace Zapheus\Bridge\Psr\Zapheus;

use Zapheus\Bridge\Psr\ServerRequest;
use Zapheus\Bridge\Psr\Stream as PsrStream;
use Zapheus\Http\Message\File;
use Zapheus\Http\Message\Uri;

/**
 * Request Test
 *
 * @package Zapheus
 * @author  Rougin Royce Gutib <rougingutib@gmail.com>
 */
class RequestTest extends \PHPUnit_Framework_TestCase
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

        $request = new ServerRequest($_SERVER, array(), array(), $_FILES);

        $this->server = $request->getServerParams();

        $this->request = new Request($request);
    }

    /**
     * Tests RequestInterface::attributes.
     *
     * @return void
     */
    public function testAttributesMethod()
    {
        $expected = array('name' => 'Rougin Royce');

        $request = $this->request->set('attributes', $expected);

        $result = $request->attributes();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests RequestInterface::cookies.
     *
     * @return void
     */
    public function testCookiesMethod()
    {
        $expected = array('name' => 'Rougin', 'address' => 'Tomorrowland');

        $cookies = $this->request->cookies();

        $cookies->set('address', 'Tomorrowland');

        $cookies->set('name', 'Rougin');

        $request = $this->request->set('cookies', $cookies);

        $result = $request->cookies()->all();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests RequestInterface::data.
     *
     * @return void
     */
    public function testDataMethod()
    {
        $expected = array('name' => 'Rougin Royce', 'age' => 20);

        $request = $this->request->set('data', $expected);

        $result = $request->data();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests RequestInterface::files.
     *
     * @return void
     */
    public function testFilesMethod()
    {
        $file = new File('/test.txt', 0, 0, 'test.txt', 'text/plain');

        $expected = array($file);

        $request = $this->request->set('files', $expected);

        $result = $request->files();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests RequestInterface::method.
     *
     * @return void
     */
    public function testMethodMethod()
    {
        $expected = 'POST';

        $request = $this->request->set('method', $expected);

        $result = $request->method();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests RequestInterface::query.
     *
     * @return void
     */
    public function testQueryMethod()
    {
        $expected = array('name' => 'Rougin Royce', 'age' => 20);

        $query = $this->request->query();

        $query->set('name', 'Rougin Royce');

        $query->set('age', 20);

        $request = $this->request->set('query', $query);

        $result = $request->query()->all();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests RequestInterface::server.
     *
     * @return void
     */
    public function testServerMethod()
    {
        $result = $this->request->server()->all();

        $expected = $_SERVER;

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests RequestInterface::target.
     *
     * @return void
     */
    public function testTargetMethod()
    {
        $expected = 'origin-form';

        $request = $this->request->set('target', $expected);

        $result = $request->target();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests RequestInterface::uri.
     *
     * @return void
     */
    public function testUriMethod()
    {
        $expected = new Uri('https://rougin.github.io');

        $request = $this->request->set('uri', $expected);

        $result = $request->uri();

        $this->assertEquals($expected, $result);
    }
}
