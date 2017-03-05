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

    /**
     * @param Request $request
     * @return $this
     */
    public function authenticateRequest(Request $request){
        $request->addHeader('X-Omnia-Access-Token', $this->id);
        return $this;
    }

}