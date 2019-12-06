<?php

namespace Zapheus\Bridge\Psr\Interop;

use Zapheus\Bridge\Psr\UploadedFile as BaseUploadedFile;
use Psr\Http\Message\UploadedFileInterface;
use Zapheus\Http\Message\FileInterface;

/**
 * Zapheus to PSR-07 Uploaded File Bridge
 *
 * @package Zapheus
 * @author  Rougin Gutib <rougingutib@gmail.com>
 */
class UploadedFile extends BaseUploadedFile
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

        $this->error = $file->error();

        $this->name = $file->name();

        $this->size = $file->size();

        $this->media = $file->type();
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
