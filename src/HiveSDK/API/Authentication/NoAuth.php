<?php

namespace HiveSDK\API\Authentication;

class NoAuth implements AuthenticationInterface {

    /**
     * @param \GuzzleHttp\Psr7\Request $request
     * @return AuthenticationResult
     */
    public function authenticateRequest(\GuzzleHttp\Psr7\Request $request){
        return new AuthenticationResult($this, $request);
    }

}