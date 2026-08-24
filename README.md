# Quillstack HTTP Request

[![Tests](https://github.com/quillstack/http-request/actions/workflows/tests.yml/badge.svg)](https://github.com/quillstack/http-request/actions/workflows/tests.yml)
[![Latest Version](https://img.shields.io/packagist/v/quillstack/http-request.svg)](https://packagist.org/packages/quillstack/http-request)
[![Downloads](https://img.shields.io/packagist/dt/quillstack/http-request.svg)](https://packagist.org/packages/quillstack/http-request)
[![PHP Version](https://img.shields.io/packagist/php-v/quillstack/http-request)](https://packagist.org/packages/quillstack/http-request)
[![StyleCI](https://github.styleci.io/repos/445684848/shield?branch=main)](https://github.styleci.io/repos/445684848?branch=main)
[![CodeFactor](https://www.codefactor.io/repository/github/quillstack/http-request/badge)](https://www.codefactor.io/repository/github/quillstack/http-request)
[![Quality Gate](https://sonarcloud.io/api/project_badges/measure?project=quillstack_http-request&metric=alert_status)](https://sonarcloud.io/summary/new_code?id=quillstack_http-request)
[![Coverage](https://sonarcloud.io/api/project_badges/measure?project=quillstack_http-request&metric=coverage)](https://sonarcloud.io/summary/new_code?id=quillstack_http-request)
[![Maintainability](https://sonarcloud.io/api/project_badges/measure?project=quillstack_http-request&metric=sqale_rating)](https://sonarcloud.io/summary/new_code?id=quillstack_http-request)
[![Reliability](https://sonarcloud.io/api/project_badges/measure?project=quillstack_http-request&metric=reliability_rating)](https://sonarcloud.io/summary/new_code?id=quillstack_http-request)
[![Security](https://sonarcloud.io/api/project_badges/measure?project=quillstack_http-request&metric=security_rating)](https://sonarcloud.io/summary/new_code?id=quillstack_http-request)
[![License](https://img.shields.io/packagist/l/quillstack/http-request)](https://github.com/quillstack/http-request/blob/main/LICENSE)

Common interface for Server Requests and Requests, based on
[PSR-7](https://www.php-fig.org/psr/psr-7/). Full documentation:
https://quillstack.org/http-request

Every HTTP method, in one place. Packages which need to name a method — a router registering
a route, a request being built from globals, a middleware answering a preflight — take it from
here rather than each writing its own string, so a typo is a missing constant rather than a
route which never matches.

## Why this exists

`'GET'` written as a string in forty places is forty chances to write `'Get'` once. This is the
HTTP methods as constants, the list of them, and the two questions worth asking about one: does
it carry a body, and is it safe to repeat.

That is genuinely all it is. It exists as a package rather than a class inside the router because
the router, the client, the server request and the middleware all need the same answer, and none
of them should depend on the others to get it.

## Requirements

- PHP 8.1 or newer

## Installation

```shell
composer require quillstack/http-request
```

## Usage

```php
use Quillstack\HttpRequest\HttpRequest;

$router->map(HttpRequest::METHOD_GET, '/users', UserController::class);

if (!in_array($method, HttpRequest::AVAILABLE_METHODS, true)) {
    throw new BadRequestHttpException("Unknown method: {$method}");
}
```

## Technical documentation

`HttpRequest` holds one constant per method and one list of all of them.

| Constant | Value |
| --- | --- |
| `HttpRequest::METHOD_GET` | `GET` |
| `HttpRequest::METHOD_POST` | `POST` |
| `HttpRequest::METHOD_HEAD` | `HEAD` |
| `HttpRequest::METHOD_PUT` | `PUT` |
| `HttpRequest::METHOD_DELETE` | `DELETE` |
| `HttpRequest::METHOD_PATCH` | `PATCH` |
| `HttpRequest::METHOD_OPTIONS` | `OPTIONS` |

`HttpRequest::AVAILABLE_METHODS` is all seven of them, in the order above. Walking it is how
[quillstack/router](https://github.com/quillstack/router) works out which methods a path
answers to when it has to send `405 Method Not Allowed` with an `Allow` header.

There is nothing else here on purpose: a package which only names things has no behaviour to
get wrong, and everything depending on it stays free of everything else.

## Benchmark

**There is nothing to measure and nothing to measure it against.**

This package is a class of constants and two static methods that read an array. No other library
does only this — the frameworks that have the same constants have them inside a larger component,
where they cannot be installed on their own or compared on their own.

A benchmark here would be timing `in_array()` against itself. The honest thing a benchmark
section can say about this package is that it does not need one.

## Tests

```shell
composer test
```

## The rest of Quillstack

This is one component of [Quillstack](https://github.com/quillstack), a PHP framework which is
as simple to use as it is strict about what it does.

- [quillstack/router](https://github.com/quillstack/router) — which answers `HEAD` with whatever answers `GET`
- [quillstack/server-request](https://github.com/quillstack/server-request) — which refuses a method nobody has heard of
- [quillstack/http-client](https://github.com/quillstack/http-client) — which sends them

## License

MIT. See [LICENSE](LICENSE).
