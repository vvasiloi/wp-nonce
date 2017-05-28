<?php

namespace Wordpress\Nonce\Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Wordpress\Nonce\Nonce;
use Wordpress\Nonce\RequestContext;

class NonceTest extends TestCase
{
    public function testWithRequestContext()
    {
        $action = 'action';
        $nonce = new Nonce($action);
        $url = sprintf('http://example.com?%s=%s', $action, $nonce->getValue());
        $context = new RequestContext(Request::create($url));

        $isValid = $nonce->validate($context);

        self::assertTrue($isValid);
    }

    public function testWithRequestContextWithoutNonce()
    {
        $nonce = new Nonce('action');
        $context = new RequestContext(Request::create('http://example.com'));

        $isValid = $nonce->validate($context);

        self::assertNotTrue($isValid);
    }

    public function testWithRequestContextAndInvalidNonce()
    {
        $action = 'action';
        $nonce = new Nonce($action);
        $url = sprintf('http://example.com?%s=%s', $action, 'invalid-nonce');
        $context = new RequestContext(Request::create($url));

        $isValid = $nonce->validate($context);

        self::assertNotTrue($isValid);
    }
}
