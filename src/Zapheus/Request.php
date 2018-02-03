<?php

namespace Zapheus\Bridge\Psr\Zapheus;

use Psr\Http\Message\ServerRequestInterface;
use Zapheus\Http\Message\Request as ZapheusRequest;

/**
 * PSR-07 to Zapheus Server Request Bridge
 *
 * @package Zapheus
 * @author  Rougin Royce Gutib <rougingutib@gmail.com>
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
        $server = $request->getServerParams();

        $cookies = $request->getCookieParams();

        list($queries, $files) = $this->globals($request);

        $data = $request->getParsedBody() ?: array();

        parent::__construct($server, $cookies, $data, $files, $queries);

        $this->set('attributes', $request->getAttributes());

        $this->set('headers', $request->getHeaders());

        $this->set('uri', new Uri($request->getUri()));

        $this->set('stream', new Stream($request->getBody()));

        $this->set('version', $request->getProtocolVersion());
    }

    /**
     * Returns an array of globals.
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $request
     * @return array
     */
    protected function globals(ServerRequestInterface $request)
    {
        list($items, $uploaded) = array(array(), array());

        $items = $request->getUploadedFiles();

        foreach ((array) $items as $key => $files) {
            $uploaded[$key] = array();

            foreach ((array) $files as $file) {
                $item = new File($file);
                
                array_push($uploaded[$key], $item);
            }
        }
   
        return array($request->getQueryParams(), $uploaded);
    }
}
