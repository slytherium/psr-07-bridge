# PSR-07 (HTTP Message) Bridge

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]][link-license]
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

Converts [PSR-07](http://www.php-fig.org/psr/psr-7) packages to [Zapheus](https://github.com/zapheus/zapheus) HTTP messages and vice versa. Also contains an implementation of [PSR-07](http://www.php-fig.org/psr/psr-7).

## Installation

Install `PSR-07 Bridge` via [Composer](https://getcomposer.org/):

``` bash
$ composer require zapheus/psr-07-bridge
```

## Basic Usage

### PSR-07 to Zapheus

Install a PSR-07 compliant package first (e.g [Diactoros](https://github.com/zendframework/zend-diactoros)):

``` bash
$ composer require zendframework/zend-diactoros
```

``` php
use Zapheus\Bridge\Psr\Zapheus\Request;
use Zend\Diactoros\ServerRequestFactory;

$psr = ServerRequestFactory::fromGlobals();

// Zapheus\Http\Message\RequestInterface
$request = new Request($psr);
```

### Zapheus to PSR-07

``` php
use Zapheus\Bridge\Psr\Interop\ServerRequest;
use Zapheus\Container\Container;
use Zapheus\Http\Message\RequestInterface;
use Zapheus\Http\MessageProvider;

$interface = RequestInterface::class;

$provider = new MessageProvider;

$container = $provider->register(new Container);

$zapheus = $container->get($interface);

// Psr\Http\Message\ServerRequestInterface
$request = new ServerRequest($zapheus);
```

## Changelog

Please see [CHANGELOG][link-changelog] for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Credits

- [All contributors][link-contributors]

## License

The MIT License (MIT). Please see [LICENSE][link-license] for more information.

[ico-code-quality]: https://img.shields.io/scrutinizer/g/zapheus/psr-07-bridge.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/zapheus/psr-07-bridge.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/zapheus/psr-07-bridge.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/zapheus/psr-07-bridge/master.svg?style=flat-square
[ico-version]: https://img.shields.io/packagist/v/zapheus/psr-07-bridge.svg?style=flat-square

[link-changelog]: https://github.com/zapheus/psr-07-bridge/blob/master/CHANGELOG.md
[link-code-quality]: https://scrutinizer-ci.com/g/zapheus/psr-07-bridge
[link-contributors]: https://github.com/zapheus/psr-07-bridge/contributors
[link-downloads]: https://packagist.org/packages/zapheus/psr-07-bridge
[link-license]: https://github.com/zapheus/psr-07-bridge/blob/master/LICENSE.md
[link-packagist]: https://packagist.org/packages/zapheus/psr-07-bridge
[link-scrutinizer]: https://scrutinizer-ci.com/g/zapheus/psr-07-bridge/code-structure
[link-travis]: https://travis-ci.org/zapheus/psr-07-bridge