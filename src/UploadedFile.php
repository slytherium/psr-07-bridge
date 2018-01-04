<?php

namespace Zapheus\Bridge\Psr;

use Psr\Http\Message\UploadedFileInterface;

/**
 * PSR-07 to Zapheus Uploaded File Bridge
 *
 * @package Zapheus
 * @author  Rougin Royce Gutib <rougingutib@gmail.com>
 */
class UploadedFile implements \Zapheus\Http\Message\UploadedFileInterface
{
    /**
     * @var \Psr\Http\Message\UploadedFileInterface
     */
    protected $file;

    /**
     * Initializes the uploaded file instance.
     *
     * @param \Psr\Http\Message\UploadedFileInterface $file
     */
    public function __construct(UploadedFileInterface $file)
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
        return $this->file->getClientFilename();
    }

    /**
     * Retrieve the media type sent by the client.
     *
     * @return string|null
     */
    public function getClientMediaType()
    {
        return $this->file->getClientMediaType();
    }

    /**
     * Retrieve the error associated with the uploaded file.
     *
     * @return integer
     */
    public function getError()
    {
        return $this->file->getError();
    }

    /**
     * Retrieve the file size.
     *
     * @return integer|null
     */
    public function getSize()
    {
        return $this->file->getSize();
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
        return new Stream($this->file->getStream());
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
        $this->file->moveTo($target);
    }
}
