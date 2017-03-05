<?php

namespace HiveSDK\API\Authentication;

use HiveSDK\API\Client;
use Httpful\Request;

class Credentials implements AuthenticationInterface {

    public $username;
    public $password;

    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function authenticateRequest(Request $request){
        $sessionId = $this->login();

        $sessionAuth = new SessionId($sessionId, $this);
        $sessionAuth->authenticateRequest($request);

        return $sessionAuth;
    }

    /**
     * @throws \RuntimeException
     * @return string
     */
    public function login(){
        $noAuth = new NoAuth();
        $client = new Client($noAuth);
        $response = $client->post('/auth/sessions', [
            'sessions' => [
                [
                    'username' => $this->username,
                    'password' => $this->password,
                    'caller' => 'WEB'
                ]
            ]
        ]);

        $sessionId = (empty($response->body->sessions[0]->sessionId)? null : $response->body->sessions[0]->sessionId);

        if(empty($sessionId)){
            throw new \RuntimeException('Login did not return session ID');
        }

        return $sessionId;
    }

}