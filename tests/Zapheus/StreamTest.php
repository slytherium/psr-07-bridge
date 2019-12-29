<?php

namespace Zapheus\Bridge\Psr\Zapheus;

use Zapheus\Bridge\Psr\Stream as PsrStream;

/**
 * Stream Test
 *
 * @package Zapheus
 * @author  Rougin Gutib <rougingutib@gmail.com>
 */
class StreamTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Zapheus\Http\Message\StreamInterface
     */
    protected $stream;

    /**
     * @var \Psr\Http\Message\StreamInterface
     */
    protected $psr;

    /**
     * Sets up the stream instance.
     *
     * @return void
     */
    public function setUp()
    {
        $file = __DIR__ . '/../Fixture/Views/LoremIpsum.php';

        $resource = fopen($file, 'r');

        $this->psr = new PsrStream($resource);

        $this->stream = new Stream($this->psr);
    }

    /**
     * Tests StreamInterface::__toString.
     *
     * @return void
     */
    public function testToStringMagicMethod()
    {
        $expected = 'Lorem ipsum dolor sit amet';

        $result = (string) $this->stream;

        $this->stream->close();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests StreamInterface::contents with \RuntimeException.
     *
     * @return void
     */
    public function testContentsMethodWithRuntimeException()
    {
        $this->setExpectedException('RuntimeException');

        $file = __DIR__ . '/../Fixture/Views/HelloWorld.php';

        $resource = fopen($file, 'w');

        $stream = new Stream(new PsrStream($resource));

        $stream->contents();
    }

    /**
     * Tests StreamInterface::read.
     *
     * @return void
     */
    public function testReadMethod()
    {
        $expected = 'Lorem ipsum dolor sit amet';

        $result = $this->stream->read(26);

        $this->stream->close();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests StreamInterface::read with \RuntimeException.
     *
     * @return void
     */
    public function testReadMethodWithRuntimeException()
    {
        $this->setExpectedException('RuntimeException');

        $file = __DIR__ . '/../Fixture/Views/HelloWorld.php';

        $resource = fopen($file, 'w');

        $stream = new Stream(new PsrStream($resource));

        $stream->read(4);
    }

    /**
     * Tests StreamInterface::rewind.
     *
     * @return void
     */
    public function testRewindMethod()
    {
        // TODO: Must be connected to PsrStream::rewind
        $expected = 'Lorem ipsum dolor sit amet';

        $this->stream->rewind();

        $result = $this->stream->contents();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests StreamInterface::write.
     *
     * @return void
     */
    public function testWriteMethod()
    {
        $file = __DIR__ . '/../Fixture/Views/PopPop.php';

        $resource = fopen($file, 'r+');

        $stream = new Stream(new PsrStream($resource));

        $expected = 'Hello world dolor sit amet';

        $stream->write($expected);

        $result = (string) $stream;

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests StreamInterface::write with \RuntimeException.
     *
     * @return void
     */
    public function testWriteMethodWithRuntimeException()
    {
        $this->setExpectedException('RuntimeException');

        $file = __DIR__ . '/../Fixture/Views/LoremIpsum.php';

        $resource = fopen($file, 'r');

        $stream = new Stream(new PsrStream($resource));

        $stream->write('Hello world');
    }
}
