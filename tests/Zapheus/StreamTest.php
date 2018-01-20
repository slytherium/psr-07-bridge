<?php

namespace Zapheus\Bridge\Psr\Zapheus;

use Zapheus\Bridge\Psr\Stream as PsrStream;

/**
 * Stream Test
 *
 * @package Zapheus
 * @author  Rougin Royce Gutib <rougingutib@gmail.com>
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
     * Tests StreamInterface::eof.
     *
     * @return void
     */
    public function testEofMethod()
    {
        $file = __DIR__ . '/../Fixture/Views/HelloWorld.php';

        $resource = fopen($file, 'w');

        $stream = new Stream(new PsrStream($resource));

        $expected = false;

        $result = $stream->eof();

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
     * Tests StreamInterface::metadata.
     *
     * @return void
     */
    public function testMetadataMethod()
    {
        $expected = array('eof' => false);

        $expected['timed_out'] = null;
        $expected['blocked'] = 1;
        $expected['wrapper_type'] = 'plainfile';
        $expected['stream_type'] = 'STDIO';
        $expected['mode'] = 'r';
        $expected['unread_bytes'] = 0;
        $expected['seekable'] = 1;
        $expected['uri'] = __DIR__ . '/../Fixture/Views/LoremIpsum.php';

        $result = $this->stream->metadata();

        $this->assertEquals($expected['uri'], $result['uri']);
    }

    /**
     * Tests StreamInterface::size.
     *
     * @return void
     */
    public function testSizeMethod()
    {
        $expected = 26;

        $result = $this->stream->size();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests StreamInterface::isReadable.
     *
     * @return void
     */
    public function testReadableMethod()
    {
        $expected = $this->psr->isReadable();

        $result = $this->stream->readable();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests StreamInterface::isSeekable.
     *
     * @return void
     */
    public function testSeekableMethod()
    {
        $expected = $this->psr->isSeekable();

        $result = $this->stream->seekable();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests StreamInterface::isWritable.
     *
     * @return void
     */
    public function testWritableMethod()
    {
        $expected = $this->psr->isWritable();

        $result = $this->stream->writable();

        $this->assertEquals($expected, $result);
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
     * Tests StreamInterface::seek and StreamInterface::tell.
     *
     * @return void
     */
    public function testSeekMethodAndTellMethod()
    {
        $expected = 2;

        $file = __DIR__ . '/../Fixture/Views/HelloWorld.php';

        $resource = fopen($file, 'w');

        $stream = new Stream(new PsrStream($resource));

        $stream->seek($expected);

        $result = $stream->tell();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests StreamInterface::seek and StreamInterface::detach.
     *
     * @return void
     */
    public function testSeekMethodAndDetachMethod()
    {
        $this->setExpectedException('RuntimeException');

        $file = __DIR__ . '/../Fixture/Views/HelloWorld.php';

        $resource = fopen($file, 'w');

        $stream = new Stream(new PsrStream($resource));

        $stream->detach();

        $stream->seek(2);
    }

    /**
     * Tests StreamInterface::tell and StreamInterface::detach.
     *
     * @return void
     */
    public function testTellMethodAndDetachMethod()
    {
        $this->setExpectedException('RuntimeException');

        $file = __DIR__ . '/../Fixture/Views/HelloWorld.php';

        $resource = fopen($file, 'w');

        $stream = new Stream(new PsrStream($resource));

        $stream->detach();

        $stream->tell();
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
