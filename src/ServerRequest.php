<?php

namespace Zapheus\Bridge\Psr;

use Psr\Http\Message\ServerRequestInterface;

/**
 * PSR-07 to Zapheus Server Request Bridge
 *
 * @package Zapheus
 * @author  Rougin Royce Gutib <rougingutib@gmail.com>
 */
class ServerRequest extends \Zapheus\Http\Message\ServerRequest
{
    /**
     * Initializes the server request instance.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     */
    public function __construct(ServerRequestInterface $request)
    {
        $server = $request->getServerParams();

        $cookies = $request->getCookieParams();

        list($query, $files) = $this->globals($request);

        $data = $request->getParsedBody();

        $attributes = $request->getAttributes();

        list($uri, $body) = $this->request($request);

        $headers = $request->getHeaders();

        $version = $request->getProtocolVersion();

        parent::__construct($server, $cookies, $query, $files, $data, $attributes, $uri, $body, $headers, $version);
    }

    /**
     * Returns a listing of globals.
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $request
     * @return array
     */
    protected function globals(ServerRequestInterface $request)
    {
        $uploaded = array();

        $items = $request->getUploadedFiles();

        $query = $request->getQueryParams();

        foreach ((array) $items as $key => $files) {
            $uploaded[$key] = array();

            foreach ((array) $files as $file) {
                $item = new UploadedFile($file);
                
                array_push($uploaded[$key], $item);
            }
        }
   
        return array($query, $uploaded);
    }

    /**
     * Returns a listing of request variables.
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $request
     * @return array
     */
    protected function request(ServerRequestInterface $request)
    {
        $uri = new Uri($request->getUri());

        return array($uri, new Stream($request->getBody()));
    }
}
