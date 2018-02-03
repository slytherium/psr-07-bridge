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
        $server = $request->server();

        $cookies = $request->cookies();

        list($queries, $files) = $this->globals($request);

        $data = $request->data();

        $attributes = $request->attributes();

        list($uri, $body) = $this->request($request);

        $headers = $request->headers();

        $version = $request->version();

        parent::__construct($server, $cookies, $queries, $files, $data, $attributes, $uri, $body, $headers, $version);
    }

    /**
     * Returns an array of global variables.
     *
     * @param  \Zapheus\Http\Message\RequestInterface $request
     * @return array
     */
    protected function globals(RequestInterface $request)
    {
        list($items, $uploaded) = array($request->files(), array());

        foreach ((array) $items as $key => $files) {
            $uploaded[(string) $key] = array();

            foreach ((array) $files as $file) {
                $item = new UploadedFile($file);
                
                array_push($uploaded[$key], $item);
            }
        }
   
        return array($request->queries(), $uploaded);
    }

    /**
     * Returns an array of request variables.
     *
     * @param  \Zapheus\Http\Message\RequestInterface $request
     * @return array
     */
    protected function request(RequestInterface $request)
    {
        $uri = new Uri($request->uri());

        $stream = new Stream($request->stream());

        return array($uri, $stream);
    }
}
