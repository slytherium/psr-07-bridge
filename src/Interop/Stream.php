<?php

namespace Zapheus\Bridge\Psr\Interop;

use Zapheus\Bridge\Psr\Stream as BaseStream;
use Zapheus\Http\Message\Stream as ZapheusStream;

/**
 * Zapheus to PSR-07 Stream Bridge
 *
 * @package Zapheus
 * @author  Rougin Royce Gutib <rougingutib@gmail.com>
 */
class Stream extends BaseStream
{
    /**
     * Initializes the stream instance.
     *
     * @param \Zapheus\Http\Message\Stream $stream
     */
    public function __construct(ZapheusStream $stream)
    {
        $this->stream = $stream->resource();
    }
}
