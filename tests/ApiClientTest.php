<?php

namespace BudTest;

use PHPUnit_Framework_TestCase;

class ApiClient extends PHPUnit_Framework_TestCase
{
    public $mockedApiClient;

    public function setup()
    {
        $this->mockedApiClient = $this->getMockBuilder('Bud\ApiClient')
            ->setMethods(['getPrisoner'])
            ->getMock();

        $this->response = json_decode(file_get_contents(__DIR__ . '/sample-data/response.json'));
    }

    public function testGetPrisonerLeia()
    {
        // Stub the method getPrisoner to return the result we want
        $this->mockedApiClient->method('getPrisoner')
            ->willreturn($this->response);

        $response = $this->mockedApiClient->getPrisoner('leia');
        $this->assertEquals($this->response, $response);
    }

    public function testFailedRequestShouldThrowException()
    {
        $mockedRequest = $this->getMockBuilder('Bud\Http\CurlRequest')
            ->setConstructorArgs(['test_url'])
            ->setMethods(['execute'])
            ->getMock();

        $mockedRequest->method('execute')
            ->willReturn(['http_code'=> 400, 'response'=> 'some_response']);

        $mockedApiClient = $this->getMockBuilder('Bud\ApiClient')
            ->setMethods(['getRequest'])->getMock();

        $mockedApiClient->method('getRequest')->willReturn($mockedRequest);

        $this->expectException('Exception');
        $mockedApiClient->getPrisoner('leia');
    }
}