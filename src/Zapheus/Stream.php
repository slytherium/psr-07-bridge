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
}
