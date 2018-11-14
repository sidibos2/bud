<?php
namespace BudTest\Http;

use Bud\Http\CurlRequest;
use Bud\Http\RequestInterface;
use PHPUnit_Framework_TestCase;

class CurlRequestTest extends PHPUnit_Framework_TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists('Bud\Http\CurlRequest'));
    }

    public function testIsInstanceOfRequestInterface()
    {
        $this->assertInstanceOf(RequestInterface::class, new CurlRequest('test_url'));
    }
}