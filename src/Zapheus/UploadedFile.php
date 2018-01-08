<?php

namespace Zapheus\Bridge\Psr\Zapheus;

use Psr\Http\Message\UploadedFileInterface;
use Zapheus\Bridge\Psr\Interop\UploadedFile as AbstractUploadedFile;
use Zapheus\Http\Message\UploadedFileInterface as ZapheusUploadedFileInterface;

/**
 * PSR-07 to Zapheus Uploaded File Bridge
 *
 * @package Zapheus
 * @author  Rougin Royce Gutib <rougingutib@gmail.com>
 */
class UploadedFile extends AbstractUploadedFile implements ZapheusUploadedFileInterface
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
     * Retrieve a stream representing the uploaded file.
     *
     * @return \Zapheus\Http\Message\StreamInterface
     *
     * @throws \RuntimeException
     */
    public function getStream()
    {
        return new Stream($this->file->getStream());
    }
}
