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

        $request = Request::get($url);
        $this->applyRequestDefaults($request);
        $this->authenticateRequest($request);

        $response = $request->send();

        return $response;
    }

    public function post($path, $payload){
        $url = $this->buildFullUrl($path);

        $request = Request::post($url);
        $request->body(json_encode($payload));
        $this->applyRequestDefaults($request);
        $this->authenticateRequest($request);

        $response = $request->send();

        return $response;
    }

    public function put($path, $payload){
        $url = $this->buildFullUrl($path);

        $request = Request::put($url);
        $request->body(json_encode($payload));
        $this->applyRequestDefaults($request);
        $this->authenticateRequest($request);

        $response = $request->send();

        return $response;
    }

    /**
     * @param string $path
     * @return string
     */
    public function buildFullUrl($path){
        return $this->baseUri . '/' . ltrim($path, '/');
    }

    /**
     * @param Request $request
     * @return $this
     */
    protected function applyRequestDefaults(Request $request){
        $request->expects('json')
            ->addHeader('Content-Type', 'application/vnd.alertme.zoo-6.1+json')
            ->addHeader('Accept', 'application/vnd.alertme.zoo-6.1+json')
            ->addHeader('X-Omnia-Client', 'Hive Web Dashboard');

        return $this;
    }

    /**
     * @param Request $request
     * @return $this
     */
    protected function authenticateRequest(Request $request){
        $this->authentication = $this->authentication->authenticateRequest($request);
        return $this;
    }

}