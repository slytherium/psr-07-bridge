<?php

namespace Zapheus\Bridge\Psr\Zapheus;

use Psr\Http\Message\UploadedFileInterface;
use Zapheus\Http\Message\FileInterface;

/**
 * PSR-07 to Zapheus Uploaded File Bridge
 *
 * @package Zapheus
 * @author  Rougin Royce Gutib <rougingutib@gmail.com>
 */
class File implements FileInterface
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
     * Returns the filename sent by the client.
     *
     * @return string|null
     */
    public function name()
    {
        return $this->file->getClientFilename();
    }

    /**
     * Returns the media type sent by the client.
     *
     * @return string|null
     */
    public function type()
    {
        return $this->file->getClientMediaType();
    }

    /**
     * Returns the error associated with the uploaded file.
     *
     * @return integer
     */
    public function error()
    {
        return $this->file->getError();
    }

    /**
     * Returns the file size.
     *
     * @return integer|null
     */
    public function size()
    {
        return $this->file->getSize();
    }

    /**
     * Returns a stream representing the uploaded file.
     *
     * @return \Psr\Http\Message\StreamInterface
     *
     * @throws \RuntimeException
     */
    public function stream()
    {
        return new Stream($this->file->getStream());
    }

    /**
     * Moves the uploaded file to a new location.
     *
     * @param string $target
     *
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     */
    public function move($target)
    {
        $this->file->moveTo($target);
    }
}
