<?php

namespace HiveSDK\API\Authentication;

use Httpful\Request;

interface AuthenticationInterface{

    public function authenticateRequest(Request $request);

}