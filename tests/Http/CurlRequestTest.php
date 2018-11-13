<?php
namespace BudTest\Http;

use Bud\Http\CurlRequest;
use PHPUnit_Framework_TestCase;

class CurlRequestTest extends PHPUnit_Framework_TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists('Bud\Http\CurlRequest'));
    }

    public function testExecuteMethodExists()
    {
        $curlRequest = new CurlRequest('test_url');
        $this->assertTrue(method_exists($curlRequest, 'execute'));
    }

    public function testSetOptionMethodExists()
    {
        $curlRequest = new CurlRequest('test_url');
        $this->assertTrue(method_exists($curlRequest, 'setOption'));
    }
}