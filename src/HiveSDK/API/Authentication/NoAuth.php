<?php

namespace HiveSDK\API\Authentication;

use Httpful\Request;

class NoAuth implements AuthenticationInterface {

    /**
     * @param Request $request
     * @return $this
     */
    public function authenticateRequest(Request $request){
        return $this;
    }

}