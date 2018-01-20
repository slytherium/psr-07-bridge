<?php

namespace Zapheus\Bridge\Psr\Interop;

use Psr\Http\Message\UploadedFileInterface;
use Zapheus\Http\Message\FileInterface;

/**
 * Zapheus to PSR-07 Uploaded File Bridge
 *
 * @package Zapheus
 * @author  Rougin Royce Gutib <rougingutib@gmail.com>
 */
class UploadedFile implements UploadedFileInterface
{
    /**
     * @var \Zapheus\Http\Message\FileInterface
     */
    protected $file;

    /**
     * Initializes the uploaded file instance.
     *
     * @param \Zapheus\Http\Message\FileInterface $file
     */
    public function __construct(FileInterface $file)
    {
        $this->file = $file;
    }

    /**
     * Retrieve the filename sent by the client.
     *
     * @return string|null
     */
    public function getClientFilename()
    {
        return $this->file->name();
    }

    /**
     * Retrieve the media type sent by the client.
     *
     * @return string|null
     */
    public function getClientMediaType()
    {
        return $this->file->type();
    }

    /**
     * Retrieve the error associated with the uploaded file.
     *
     * @return integer
     */
    public function getError()
    {
        return $this->file->error();
    }

    /**
     * Retrieve the file size.
     *
     * @return integer|null
     */
    public function getSize()
    {
        return $this->file->size();
    }

    /**
     * Retrieve a stream representing the uploaded file.
     *
     * @return \Psr\Http\Message\StreamInterface
     *
     * @throws \RuntimeException
     */
    public function getStream()
    {
        return new Stream($this->file->stream());
    }

    /**
     * Move the uploaded file to a new location.
     *
     * @param string $target
     *
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     */
    public function moveTo($target)
    {
        $this->file->move($target);
    }
}
