<?php

namespace Zapheus\Bridge\Psr\Interop;

use Zapheus\Http\Message\Stream as ZapheusStream;

/**
 * Stream Test
 *
 * @package Zapheus
 * @author  Rougin Gutib <rougingutib@gmail.com>
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
}
