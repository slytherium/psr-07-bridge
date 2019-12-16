<?php

namespace Zapheus\Bridge\Psr\Zapheus;

use Psr\Http\Message\ServerRequestInterface;
use Zapheus\Http\Message\Request as ZapheusRequest;

/**
 * PSR-07 to Zapheus Server Request Bridge
 *
 * @package Zapheus
 * @author  Rougin Gutib <rougingutib@gmail.com>
 */
class Request extends ZapheusRequest
{
    /**
     * Initializes the server request instance.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     */
    public function __construct(ServerRequestInterface $request)
    {
        $this->data = $request->getParsedBody();

        $this->cookies = $request->getCookieParams();

        $this->server = $request->getServerParams();

        $this->files = $this->uploaded($request);

        $this->attributes = $request->getAttributes();

        $this->queries = $request->getQueryParams();

        $this->headers = (array) $request->getHeaders();

        $this->uri = new Uri($request->getUri());

        $this->stream = new Stream($request->getBody());

        $this->version = $request->getProtocolVersion();
    }

    /**
     * Returns an array of uploaded files.
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $request
     * @return \Zapheus\Http\Message\FileInterface[]
     */
    protected function uploaded(ServerRequestInterface $request)
    {
        list($items, $uploaded) = array(array(), array());

        $items = $request->getUploadedFiles();

        foreach ((array) $items as $key => $files)
        {
            $uploaded[$key] = array();

            foreach ((array) $files as $file)
            {
                array_push($uploaded[$key], new File($file));
            }
        }

        return (array) $uploaded;
    }
}
