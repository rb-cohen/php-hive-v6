<?php

namespace HiveSDK\API\Authentication;

use GuzzleHttp\Psr7\Request;

class AuthenticationResult{

    public $authentication;
    public $request;

    public function __construct(AuthenticationInterface $authentication, Request $request)
    {
        $this->authentication = $authentication;
        $this->request = $request;
    }

}