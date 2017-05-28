<?php

namespace Wordpress\Nonce\Tests;

use PHPUnit\Framework\TestCase;
use Wordpress\Nonce\RequestContext;

class RequestContextTest extends TestCase
{
    protected function tearDown()
    {
        $_GET = [];
    }

    public function testGet()
    {
        $_GET = ['foo' => 'bar'];
        $context = new RequestContext();

        $this->assertSame('bar', $context->get('foo'));
        $this->assertSame('', $context->get('baz'));
    }

    public function testHas()
    {
        $_GET = ['foo' => 'bar'];

        $context = new RequestContext();

        $this->assertTrue($context->has('foo'));
        $this->assertNotTrue($context->has('baz'));
    }
}