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

        $file = __DIR__ . '/../Fixture/Views/HelloWorld.php';

        $_FILES['file']['error'] = array(0);
        $_FILES['file']['name'] = array(basename($file));
        $_FILES['file']['size'] = array(filesize($file));
        $_FILES['file']['tmp_name'] = array($file);
        $_FILES['file']['type'] = array(mime_content_type($file));

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

        $request = $this->request->with('attributes', $expected);

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

        $request = $this->request->with('cookies', $expected);

        $result = $request->cookies();

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

        $request = $this->request->with('data', $expected);

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
        $file = __DIR__ . '/../Fixture/Views/HelloWorld.php';

        $file = new File($file, basename($file));

        $expected = array($file);

        $request = $this->request->with('files', $expected);

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

        $request = $this->request->with('method', $expected);

        $result = $request->method();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests RequestInterface::queries.
     *
     * @return void
     */
    public function testQueriesMethod()
    {
        $expected = array('name' => 'Rougin Royce', 'age' => 20);

        $request = $this->request->with('queries', $expected);

        $result = $request->queries();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests RequestInterface::server.
     *
     * @return void
     */
    public function testServerMethod()
    {
        $result = $this->request->server();

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

        $request = $this->request->with('target', $expected);

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

        $request = $this->request->with('uri', $expected);

        $result = $request->uri();

        $this->assertEquals($expected, $result);
    }
}
