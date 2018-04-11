<?php

namespace Zapheus\Bridge\Psr;

use Zapheus\Container\WritableInterface;
use Zapheus\Provider\ProviderInterface;

/**
 * Message Provider
 *
 * @package Zapheus
 * @author  Rougin Royce Gutib <rougingutib@gmail.com>
 */
class MessageProvider implements ProviderInterface
{
    const PSR_REQUEST = 'Psr\Http\Message\ServerRequestInterface';

    const PSR_RESPONSE = 'Psr\Http\Message\ResponseInterface';

    const ZAPHEUS_REQUEST = 'Zapheus\Http\Message\RequestInterface';

    const ZAPHEUS_RESPONSE = 'Zapheus\Http\Message\ResponseInterface';

    /**
     * Registers the bindings in the container.
     *
     * @param  \Zapheus\Container\WritableInterface $container
     * @return \Zapheus\Container\ContainerInterface
     */
    public function register(WritableInterface $container)
    {
        if ($container->has(self::ZAPHEUS_REQUEST)) {
            $request = $container->get(self::ZAPHEUS_REQUEST);

            $request = new Interop\ServerRequest($request);

            $container->set(self::PSR_REQUEST, $request);
        }

        if ($container->has(self::ZAPHEUS_RESPONSE)) {
            $response = $container->get(self::ZAPHEUS_RESPONSE);

            $response = new Interop\Response($response);

            $container->set(self::PSR_RESPONSE, $response);
        }

        return $container;
    }
}
