<?php

namespace HiveSDK\API\Authentication;

use Httpful\Request;

class SessionId implements AuthenticationInterface {

    public $id;
    public $credentials;

    public function __construct($id, $fromCredentials = null)
    {
        $this->id = $id;
        $this->credentials = $fromCredentials;
    }

    public function authenticateRequest(\GuzzleHttp\Psr7\Request $request){
        $request = $request->withHeader('X-Omnia-Access-Token', $this->id);
        return new AuthenticationResult($this, $request);
    }

}