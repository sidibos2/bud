<?php

namespace Bud;

use Bud\Http\CurlRequest;

class ApiClient
{
    const BASE_URL = 'https://death.star.api';

    const OAUTH2_CLIENT_ID = 'R2D2';
    const OAUTH2_CLIENT_SECRET = 'Alderan';

    const TOKEN_ENDPOINT = '/token';
    const REACTOR_ENDPOINT = '/reactor/exhaust/';
    const PRISONER_lEA_ENDPOINT = '/prisoner/';

    public function getToken()
    {
        $postFields = [
            'client_id' => self::OAUTH2_CLIENT_ID,
            'client_secret' => self::OAUTH2_CLIENT_SECRET,
            'grant_type' => 'client_credentials',
        ];

        $curlRequest = new CurlRequest(self::BASE_URL . self::TOKEN_ENDPOINT);
        $curlRequest->setOption(CURLOPT_POSTFIELDS, http_build_query($postFields));
        $curlRequest->setOption(CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
        $curlRequest->setOption(CURLOPT_RETURNTRANSFER, true);

        $response = json_decode($curlRequest->execute());

        $curlRequest->close();

        return $response->access_token;
    }

    public function getReactorExhaust($num)
    {
        $token = $this->getToken();
        $httpHeaders = [
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json',
            'x-torpedoes: 2',
        ];

        $request = new CurlRequest(self::BASE_URL . self::REACTOR_ENDPOINT . $num);
        $request->setOption(CURLOPT_HTTPHEADER, $httpHeaders);
        $request->setOption(CURLOPT_CUSTOMREQUEST, 'DELETE');
        $response = json_decode($request->execute());

        return $response;
    }

    public function getPrisoner($name)
    {
        $token = $this->getToken();
        $httpHeaders = [
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json',
        ];

        $request = new CurlRequest(self::BASE_URL . self::PRISONER_lEA_ENDPOINT . $name);
        $request->setOption(CURLOPT_HTTPHEADER, $httpHeaders);

        $response = json_decode($request->execute());

        return $response;
    }
}