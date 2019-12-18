<?php

namespace Zapheus\Bridge\Psr\Zapheus;

use Psr\Http\Message\StreamInterface as PsrStreamInterface;
use Zapheus\Http\Message\StreamInterface;

/**
 * PSR-07 to Zapheus Stream Bridge
 *
 * @package Zapheus
 * @author  Rougin Gutib <rougingutib@gmail.com>
 */
class Stream implements StreamInterface
{
    /**
     * @var \Psr\Http\Message\StreamInterface
     */
    protected $stream;

    /**
     * Initializes the stream instance.
     *
     * @param \Psr\Http\Message\StreamInterface $stream
     */
    public function __construct(PsrStreamInterface $stream)
    {
        $this->stream = $stream;
    }

    /**
     * Reads all data from the stream into a string, from the beginning to end.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->stream->__toString();
    }

    /**
     * Closes the stream and any underlying resources.
     *
     * @return void
     */
    public function close()
    {
        $this->stream->close();
    }

    /**
     * Returns the remaining contents in a string.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    public function contents()
    {
        return $this->stream->getContents();
    }

    /**
     * Read data from the stream.
     *
     * @param  integer $length
     * @return string
     *
     * @throws \RuntimeException
     */
    public function read($length)
    {
        return $this->stream->read($length);
    }

    /**
     * Seek to the beginning of the stream.
     *
     * @throws \RuntimeException
     */
    public function rewind()
    {
        return $this->stream->rewind();
    }

    /**
     * Write data to the stream.
     *
     * @param  string $string
     * @return integer
     *
     * @throws \RuntimeException
     */
    public function write($string)
    {
        return $this->stream->write($string);
    }
}
