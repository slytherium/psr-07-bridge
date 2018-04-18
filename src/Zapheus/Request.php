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
        $data = (array) $request->getParsedBody();

        $cookies = $request->getCookieParams();

        parent::__construct($request->getServerParams(), $cookies, $data);

        $this->set('files', $this->uploaded($request));

        $this->set('attributes', $request->getAttributes());

        $this->set('queries', $request->getQueryParams());

        $this->set('headers', (array) $request->getHeaders());

        $this->set('uri', new Uri($request->getUri()));

        $this->set('stream', new Stream($request->getBody()));

        $this->set('version', $request->getProtocolVersion());
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

        foreach ((array) $items as $key => $files) {
            $uploaded[$key] = array();

            foreach ((array) $files as $file) {
                $item = new File($file);

                array_push($uploaded[$key], $item);
            }
        }

        return (array) $uploaded;
    }
}
