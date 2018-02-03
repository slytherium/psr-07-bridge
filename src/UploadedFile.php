<?php

namespace Zapheus\Bridge\Psr;

use Psr\Http\Message\UploadedFileInterface;

/**
 * Uploaded File
 *
 * @package Zapheus
 * @author  Rougin Royce Gutib <rougingutib@gmail.com>
 */
class UploadedFile implements UploadedFileInterface
{
    /**
     * @var string
     */
    protected $file;

    /**
     * @var integer|null
     */
    protected $size;

    /**
     * @var integer
     */
    protected $error;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $media;

    /**
     * Initializes the uploaded file instance.
     *
     * @param string       $file
     * @param integer|null $size
     * @param integer      $error
     * @param string|null  $name
     * @param string|null  $media
     */
    public function __construct($file, $size = null, $error = UPLOAD_ERR_OK, $name = null, $media = null)
    {
        $this->error = $error;

        $this->file = $file;

        $this->media = $media;

        $this->name = $name;

        $this->size = $size;
    }

    /**
     * Retrieves the filename sent by the client.
     *
     * @return string|null
     */
    public function getClientFilename()
    {
        return $this->name;
    }

    /**
     * Retrieves the media type sent by the client.
     *
     * @return string|null
     */
    public function getClientMediaType()
    {
        return $this->media;
    }

    /**
     * Retrieves the error associated with the uploaded file.
     *
     * @return integer
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * Retrieves the file size.
     *
     * @return integer|null
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Retrieves a stream representing the uploaded file.
     *
     * @return \Psr\Http\Message\StreamInterface
     *
     * @throws \RuntimeException
     */
    public function getStream()
    {
        $stream = fopen($this->file, 'r');

        return new Stream($stream ?: null);
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
        rename($this->file, $target);
    }

    /**
     * Parses the $_FILES into multiple \File instances.
     *
     * @param  array $uploaded
     * @param  array $files
     * @return \Zapheus\Http\Message\FileInterface[]
     */
    public static function normalize(array $uploaded, $files = array())
    {
        foreach ((array) $uploaded as $name => $file) {
            list($files[$name], $items) = array($file, array());

            if (isset($file['name']) === true) {
                foreach ($file['name'] as $key => $value) {
                    $items[] = self::create($file, $key);
                }

                $files[$name] = $items;
            }
        }

        return $files;
    }

    /**
     * Creates a new UploadedFile instance.
     *
     * @param  array   $file
     * @param  integer $key
     * @return \Psr\Http\Message\UploadedFile
     */
    protected static function create(array $file, $key)
    {
        $tmp = $file['tmp_name'][$key];

        $size = $file['size'][$key];

        $error = $file['error'][$key];

        $original = $file['name'][$key];

        $type = $file['type'][$key];

        return new UploadedFile($tmp, $size, $error, $original, $type);
    }
}
