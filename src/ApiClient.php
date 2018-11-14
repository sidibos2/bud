<?php

namespace Bud;

use Bud\Http\CurlRequest;
use Bud\Http\Request;

class ApiClient
{
    // Considering any code is a failure
    const SUCCESS = 200;
    const BASE_URL = 'https://death.star.api';
    const OAUTH2_CLIENT_ID = 'R2D2';
    const OAUTH2_CLIENT_SECRET = 'Alderan';
    const TOKEN_ENDPOINT = '/token';
    const REACTOR_ENDPOINT = '/reactor/exhaust/';
    const PRISONER_lEA_ENDPOINT = '/prisoner/';

    /**
     * @return mixed
     */
    public function getToken()
    {
        $postFields = [
            'client_id' => self::OAUTH2_CLIENT_ID,
            'client_secret' => self::OAUTH2_CLIENT_SECRET,
            'grant_type' => 'client_credentials',
        ];

        $request = $this->getRequest(self::BASE_URL . self::TOKEN_ENDPOINT);
        $request->setOption(CURLOPT_POSTFIELDS, http_build_query($postFields));
        $request->setOption(CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
        $request->setOption(CURLOPT_RETURNTRANSFER, true);

        $response = $this->processResponse($request->execute());

        return $response->access_token;
    }

    /**
     * @param int $num
     *
     * @throws \Exception
     */
    public function getReactorExhaust($num)
    {
        if (empty($num)) {
            throw new \Exception('Exhaust number cannot be empty');
        }

        $token = $this->getToken();
        $httpHeaders = [
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json',
            'x-torpedoes: 2',
        ];

        $request = $this->getRequest(self::BASE_URL . self::REACTOR_ENDPOINT . $num);
        $request->setOption(CURLOPT_HTTPHEADER, $httpHeaders);
        $request->setOption(CURLOPT_CUSTOMREQUEST, 'DELETE');

        $this->processResponse($request->execute());
    }

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function getPrisoner($name)
    {
        if (empty($name)) {
            throw new Exception('Prisoner name cannot be empty');
        }

        $token = $this->getToken();
        $httpHeaders = [
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json',
        ];

        $request = $this->getRequest(self::BASE_URL . self::PRISONER_lEA_ENDPOINT . $name);
        $request->setOption(CURLOPT_HTTPHEADER, $httpHeaders);

        return $this->processResponse($request->execute());
    }

    /**
     * @param string $endpoint
     *
     * @return CurlRequest
     *
     * @throws \Exception
     */
    public function getRequest($endpoint)
    {
        if (empty($url)) {
            throw new \Exception('Endpoint cannot be empty');
        }
        return new CurlRequest($endpoint);
    }

    /**
     * @param array $result
     *
     * @return mixed
     *
     * @throws \Exception
     */
    private function processResponse(array $result)
    {
        $httpCode = (int) $result['http_code'];
        if ($httpCode !== self::SUCCESS) {
            throw new \Exception('Error -  Request error', $httpCode);
        }
        return json_decode($result['response']);
    }
}