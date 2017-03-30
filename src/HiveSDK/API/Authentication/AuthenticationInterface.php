<?php

namespace HiveSDK\API\Authentication;

interface AuthenticationInterface{

    /**
     * @param \GuzzleHttp\Psr7\Request $request
     * @return AuthenticationResult
     */
    public function authenticateRequest(\GuzzleHttp\Psr7\Request $request);

}