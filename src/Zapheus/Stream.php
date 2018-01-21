<?php

namespace Zapheus\Bridge\Psr\Zapheus;

use Psr\Http\Message\StreamInterface as PsrStreamInterface;
use Zapheus\Http\Message\StreamInterface;

/**
 * PSR-07 to Zapheus Stream Bridge
 *
 * @package Zapheus
 * @author  Rougin Royce Gutib <rougingutib@gmail.com>
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
        return $this->stream->close();
    }

    /**
     * Returns the remaining contents in a string
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
     * Separates any underlying resources from the stream.
     *
     * @return resource|null
     */
    public function detach()
    {
        return $this->stream->detach();
    }

    /**
     * Returns true if the stream is at the end of the stream.
     *
     * @return boolean
     */
    public function eof()
    {
        return $this->stream->eof();
    }

    /**
     * Get stream metadata as an associative array or retrieve a specific key.
     *
     * @param  string $key
     * @return array|mixed|null
     */
    public function metadata($key = null)
    {
        return $this->stream->getMetadata($key);
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
     * Returns whether or not the stream is readable.
     *
     * @return boolean
     */
    public function readable()
    {
        return $this->stream->isReadable();
    }

    /**
     * Seek to the beginning of the stream.
     *
     * @throws \RuntimeException
     */
    public function rewind()
    {
        return $this->seek(0);
    }

    /**
     * Seek to a position in the stream.
     *
     * @param integer $offset
     * @param integer $whence
     *
     * @throws \RuntimeException
     */
    public function seek($offset, $whence = SEEK_SET)
    {
        return $this->stream->seek($offset, $whence);
    }

    /**
     * Returns whether or not the stream is seekable.
     *
     * @return boolean
     */
    public function seekable()
    {
        return $this->stream->isSeekable();
    }

    /**
     * Get the size of the stream if known.
     *
     * @return integer|null
     */
    public function size()
    {
        return $this->stream->getSize();
    }

    /**
     * Returns the current position of the file read/write pointer.
     *
     * @return integer
     *
     * @throws \RuntimeException
     */
    public function tell()
    {
        return $this->stream->tell();
    }

    /**
     * Returns whether or not the stream is writable.
     *
     * @return boolean
     */
    public function writable()
    {
        return $this->stream->isWritable();
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
