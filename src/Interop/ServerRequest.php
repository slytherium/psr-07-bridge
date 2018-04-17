<?php

namespace Zapheus\Bridge\Psr\Interop;

use Zapheus\Bridge\Psr\ServerRequest as PsrServerRequest;
use Zapheus\Http\Message\RequestInterface;

/**
 * Zapheus to PSR-07 Server Request Bridge
 *
 * @package Zapheus
 * @author  Rougin Royce Gutib <rougingutib@gmail.com>
 */
class ServerRequest extends PsrServerRequest
{
    /**
     * Initializes the server request instance.
     *
     * @param \Zapheus\Http\Message\RequestInterface $request
     */
    public function __construct(RequestInterface $request)
    {
        $server = (array) $request->server();

        $cookies = $request->cookies();

        parent::__construct($server, $cookies, $request->queries());

        $this->headers = $request->headers();

        $this->version = $request->version();

        $this->data = $request->data();

        $this->attributes = $request->attributes();

        $this->uri = new Uri($request->uri());

        $this->body = new Stream($request->stream());

        $this->uploaded = $this->uploaded($request);
    }

    /**
     * Returns an array of global variables.
     *
     * @param  \Zapheus\Http\Message\RequestInterface $request
     * @return \Psr\Http\Message\UploadedFileInterface[]
     */
    protected function uploaded(RequestInterface $request)
    {
        list($items, $uploaded) = array($request->files(), array());

        foreach ((array) $items as $key => $files) {
            $uploaded[(string) $key] = array();

            foreach ((array) $files as $file) {
                $item = new UploadedFile($file);
                
                array_push($uploaded[$key], $item);
            }
        }
   
        return (array) $uploaded;
    }
}
