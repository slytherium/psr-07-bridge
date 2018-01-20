<?php

namespace Zapheus\Bridge\Psr\Interop;

use Zapheus\Http\Message\Stream as ZapheusStream;

/**
 * Stream Test
 *
 * @package Zapheus
 * @author  Rougin Royce Gutib <rougingutib@gmail.com>
 */
class StreamTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Psr\Http\Message\StreamInterface
     */
    protected $stream;

    /**
     * @var \Zapheus\Http\Message\StreamInterface
     */
    protected $zapheus;

    /**
     * Sets up the stream instance.
     *
     * @return void
     */
    public function setUp()
    {
        $file = __DIR__ . '/../Fixture/Views/LoremIpsum.php';

        $resource = fopen($file, 'r');

        $this->zapheus = new ZapheusStream($resource);

        $this->stream = new Stream($this->zapheus);
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

        $stream = new Stream(new ZapheusStream($resource));

        $expected = false;

        $result = $stream->eof();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests StreamInterface::getContents with \RuntimeException.
     *
     * @return void
     */
    public function testGetContentsMethodWithRuntimeException()
    {
        $this->setExpectedException('RuntimeException');

        $file = __DIR__ . '/../Fixture/Views/HelloWorld.php';

        $resource = fopen($file, 'w');

        $stream = new Stream(new ZapheusStream($resource));

        $stream->getContents();
    }

    /**
     * Tests StreamInterface::getMetadata.
     *
     * @return void
     */
    public function testGetMetadataMethod()
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

        $result = $this->stream->getMetadata();

        $this->assertEquals($expected['uri'], $result['uri']);
    }

    /**
     * Tests StreamInterface::getSize.
     *
     * @return void
     */
    public function testGetSizeMethod()
    {
        $expected = 26;

        $result = $this->stream->getSize();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests StreamInterface::isReadable.
     *
     * @return void
     */
    public function testIsReadableMethod()
    {
        $expected = $this->zapheus->readable();

        $result = $this->stream->isReadable();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests StreamInterface::isSeekable.
     *
     * @return void
     */
    public function testIsSeekableMethod()
    {
        $expected = $this->zapheus->seekable();

        $result = $this->stream->isSeekable();

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests StreamInterface::isWritable.
     *
     * @return void
     */
    public function testIsWritableMethod()
    {
        $expected = $this->zapheus->writable();

        $result = $this->stream->isWritable();

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

        $stream = new Stream(new ZapheusStream($resource));

        $stream->read(4);
    }

    /**
     * Tests StreamInterface::rewind.
     *
     * @return void
     */
    public function testRewindMethod()
    {
        // TODO: Must be connected to ZapheusStream::rewind
        $expected = 'Lorem ipsum dolor sit amet';

        $this->stream->rewind();

        $result = $this->stream->getContents();

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

        $stream = new Stream(new ZapheusStream($resource));

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

        $stream = new Stream(new ZapheusStream($resource));

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

        $stream = new Stream(new ZapheusStream($resource));

        $stream->detach();

        $stream->tell();
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

        $stream = new Stream(new ZapheusStream($resource));

        $stream->write('Hello world');
    }
}
