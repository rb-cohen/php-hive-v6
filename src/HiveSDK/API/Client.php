<?php

namespace HiveSDK\API;

use HiveSDK\API\Authentication\AuthenticationInterface;
use Httpful\Request;

class Client{

    protected $baseUri = 'https://api-prod.bgchprod.info:443/omnia';
    protected $authentication;

    /**
     * Client constructor.
     * @param AuthenticationInterface $authentication
     */
    public function __construct(AuthenticationInterface $authentication)
    {
        $this->authentication = $authentication;
    }

    /**
     * @param string $uri
     * @return $this
     */
    public function setBaseUri($uri){
        $this->baseUri = rtrim($uri, '/');
        return $this;
    }

    public function get($path){
        $url = $this->buildFullUrl($path);

        $request = new \GuzzleHttp\Psr7\Request('GET', $url);
        $request = $this->applyRequestDefaults($request);
        $request = $this->authenticateRequest($request);

        return $this->makeRequest($request);
    }

    public function post($path, $payload){
        $url = $this->buildFullUrl($path);

        $request = new \GuzzleHttp\Psr7\Request('POST', $url);

        $body = \GuzzleHttp\Psr7\stream_for(\GuzzleHttp\json_encode($payload));
        $request = $request->withBody($body);
        $request = $this->applyRequestDefaults($request);
        $request = $this->authenticateRequest($request);

        return $this->makeRequest($request);
    }

    public function put($path, $payload){
        $url = $this->buildFullUrl($path);

        $request = new \GuzzleHttp\Psr7\Request('PUT', $url);

        $body = \GuzzleHttp\Psr7\stream_for(\GuzzleHttp\json_encode($payload));
        $request = $request->withBody($body);
        $request = $this->applyRequestDefaults($request);
        $request = $this->authenticateRequest($request);

        return $this->makeRequest($request);
    }

    /**
     * @param string $path
     * @return string
     */
    public function buildFullUrl($path){
        return $this->baseUri . '/' . ltrim($path, '/');
    }

    /**
     * @param \GuzzleHttp\Psr7\Request $request
     * @return mixed
     */
    protected function makeRequest(\GuzzleHttp\Psr7\Request $request){
        $http = new \GuzzleHttp\Client();
        $response = $http->send($request);

        return \GuzzleHttp\json_decode($response->getBody());
    }

    /**
     * @param \GuzzleHttp\Psr7\Request $request
     * @return \GuzzleHttp\Psr7\MessageTrait|\GuzzleHttp\Psr7\Request
     */
    protected function applyRequestDefaults(\GuzzleHttp\Psr7\Request $request){
        $request = $request->withHeader('Content-Type', 'application/vnd.alertme.zoo-6.1+json');
        $request = $request->withHeader('Accept', 'application/vnd.alertme.zoo-6.1+json');
        $request = $request->withHeader('X-Omnia-Client', 'X-Omnia-Client');
        return $request;
    }

    /**
     * @param \GuzzleHttp\Psr7\Request $request
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function authenticateRequest(\GuzzleHttp\Psr7\Request $request){
        $result = $this->authentication->authenticateRequest($request);
        $this->authentication = $result->authentication;
        return $result->request;
    }

}