WP Nonce
======


**This is an OOP wrapper for WordPress Nonce.**

## `NonceInterface`

Base interface for all nonces that has the following methods:

- `getAction()` get nonce action
- `getValue()` get nonce value for that action
- `validate()` validate nonce against a given context

## `ContextInterface`

Base interface for all nonce contexts. It has the following methods:

- `has()` check if context has the given nonce action
- `get()` returns nonce value for given action

## Bundled implementations

This package ships with 2 implementations of the above interfaces: `Nonce` and `RequestContext`

### `Nonce`

A simple implementation of `NonceInterface` that accepts 2 parameters: nonce action name and it's lifetime in seconds (defaults to 1h).
```php
    $nonce = new Nonce('action');
    $isValid = $nonce->validate(); // if no context is provided, it will use RequestContext (see below)
```
`getValue()` and `validate()` functions adds `nonce_life` filter to check nonce lifetime.

### `RequestContext`

This class uses `Symfony\Component\HttpFoundation\Request` to retrieve nonce value from request (query string and request body parameters).

A similar implementation could also work with headers:

```php

use Symfony\Component\HttpFoundation\Request;

class RequestHeadersContext implements ContextInterface
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @param Request|null $request
     */
    public function __construct(Request $request = null)
    {
        $this->request = null !== $request ? $request : Request::createFromGlobals();
    }

    /**
     * @param string $action
     *
     * @return bool
     */
    public function has($action)
    {
        return $this->request->headers->has($action);
    }

    /**
     * @param string $action
     *
     * @return string
     */
    public function get($action)
    {
        return $this->request->headers->get($action, '');
    }
}
```

## Installation

`composer require vvasiloi/wp-nonce`

## Requirements

- PHP 5.5+
- Composer

## License

MIT