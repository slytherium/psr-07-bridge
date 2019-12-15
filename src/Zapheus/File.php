<?php

namespace Zapheus\Bridge\Psr\Zapheus;

use Psr\Http\Message\UploadedFileInterface;
use Zapheus\Http\Message\FileInterface;
use Zapheus\Http\Message\File as BaseFile;

/**
 * PSR-07 to Zapheus Uploaded File Bridge
 *
 * @package Zapheus
 * @author  Rougin Gutib <rougingutib@gmail.com>
 */
class File extends BaseFile
{
    /**
     * @var \Psr\Http\Message\UploadedFileInterface
     */
    protected $psr;

    /**
     * Initializes the uploaded file instance.
     *
     * @param \Psr\Http\Message\UploadedFileInterface $file
     */
    public function __construct(UploadedFileInterface $file)
    {
        $this->psr = $file;

        $this->type = $file->getClientMediaType();

        $this->name = $file->getClientFilename();

        $this->size = (integer) $file->getSize();

        $this->error = $file->getError();
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
        return new Stream($this->psr->getStream());
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
        $this->psr->moveTo($target);
    }
}
