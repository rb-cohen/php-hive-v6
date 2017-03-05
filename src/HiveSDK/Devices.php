<?php

namespace HiveSDK;

use HiveSDK\API\Client;

class Devices{

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function all(){
        return $this->client->get('/nodes')->body->nodes;
    }

    public function id($id){
        $response = $this->client->get('/nodes/' . $id);

        if(empty($response->body->nodes)){
            throw new \RuntimeException('Device not found');
        }

        if(count($response->body->nodes) > 1){
            throw new \RuntimeException('More than one device returned');
        }

        return $response->body->nodes[0];
    }

}