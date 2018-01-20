<?php

namespace Zapheus\Bridge\Psr\Zapheus;

use Psr\Http\Message\StreamInterface;
use Zapheus\Bridge\Psr\Interop\Stream as AbstractStream;
use Zapheus\Http\Message\StreamInterface as ZapheusStreamInterface;

/**
 * PSR-07 to Zapheus Stream Bridge
 *
 * @package Zapheus
 * @author  Rougin Royce Gutib <rougingutib@gmail.com>
 */
class Stream extends AbstractStream implements ZapheusStreamInterface
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
    public function __construct(StreamInterface $stream)
    {
        $this->stream = $stream;
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
     * Get the size of the stream if known.
     *
     * @return integer|null
     */
    public function size()
    {
        return $this->stream->getSize();
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
     * Returns whether or not the stream is seekable.
     *
     * @return boolean
     */
    public function seekable()
    {
        return $this->stream->isSeekable();
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
}
