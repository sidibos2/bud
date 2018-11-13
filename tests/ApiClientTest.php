<?php

namespace BudTest;

use PHPUnit_Framework_TestCase;

class ApiClient extends PHPUnit_Framework_TestCase
{
    public function setup()
    {
        $this->apiClient = $this->getMockBuilder('Bud\ApiClient')
            ->setMethods(['getPrisoner'])
            ->getMock();

        $this->response = json_decode(file_get_contents(__DIR__ . '/sample-data/response.json'));
    }

    public function testGetPrisonerLeia()
    {
        // Stub the method getPrisoner to return the result we want
        $this->apiClient->method('getPrisoner')
            ->willreturn($this->response);
        $response = $this->apiClient->getPrisoner('leai');
        $this->assertEquals($this->response, $response);
    }
}