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

### Requirements

- PHP 8.1 or newer

### Installation

```shell
composer require quillstack/http-request
```

### Usage

```php
use Quillstack\HttpRequest\HttpRequest;

$router->map(HttpRequest::METHOD_GET, '/users', UserController::class);

if (!in_array($method, HttpRequest::AVAILABLE_METHODS, true)) {
    throw new BadRequestHttpException("Unknown method: {$method}");
}
```

### Technical documentation

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

### Unit tests

```shell
composer test
```

### Docker

```shell
docker-compose up -d
docker exec -w /var/www/html -it quillstack_http-request sh
```

### License

MIT. See [LICENSE](LICENSE).
