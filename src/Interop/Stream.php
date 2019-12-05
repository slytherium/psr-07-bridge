<?php

namespace Zapheus\Bridge\Psr\Interop;

use Zapheus\Bridge\Psr\Stream as BaseStream;
use Zapheus\Http\Message\StreamInterface;

/**
 * Zapheus to PSR-07 Stream Bridge
 *
 * NOTE: This stream is a read-only stream since it cannot
 * return the resource from the stream of Zapheus. Thus,
 * methods such as "getMetadata", "getSize", "eof", "seek",
 * and "tell" will not be utilized in this class. It can
 * write but only using the implemented Zapheus stream.
 *
 * @package Zapheus
 * @author  Rougin Gutib <rougingutib@gmail.com>
 */
class Stream extends BaseStream
{
    /**
     * @var \Zapheus\Http\Message\StreamInterface
     */
    protected $zapheus;

    /**
     * Initializes the stream instance.
     *
     * @param \Zapheus\Http\Message\StreamInterface $stream
     */
    public function __construct(StreamInterface $stream)
    {
        $this->zapheus = $stream;

        parent::__construct();
    }

    /**
     * Closes the stream and any underlying resources.
     *
     * @return void
     */
    public function close()
    {
        $this->zapheus->close();
    }

    /**
     * Returns the remaining contents in a string
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    public function getContents()
    {
        return $this->zapheus->contents();
    }

    /**
     * Reads data from the stream.
     *
     * @param  integer $length
     * @return string
     */
    public function read($length)
    {
        return $this->zapheus->read($length);
    }

    /**
     * Seeks to the beginning of the stream.
     *
     * @throws \RuntimeException
     */
    public function rewind()
    {
        $this->zapheus->rewind();
    }

    /**
     * Writes data to the stream.
     *
     * @param  string $string
     * @return integer
     */
    public function write($string)
    {
        return $this->zapheus->write($string);
    }
}
